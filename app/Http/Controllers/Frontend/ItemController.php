<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemStoreRequest;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemChangeLog;
use App\Models\ItemHistory;
use App\Models\UploadedFiles;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $categories = Category::all();
        $items = Item::with(['category', 'subcategory'])->where('author_id', user()->id)->paginate(15);

        return view('frontend.dashboard.item.index', compact('categories', 'items'));
    }

    public function create(Request $request): View
    {
        $categories = Category::all();
        $selectedCategory = Category::with('subcategories')->whereSlug($request->category)->firstOrFail();

        // put category_id on session
        session()->put('selectedCategory', $selectedCategory->id);

        $uploadedFiles = UploadedFiles::where('author_id', auth()->id())
            ->where('category_id', session()->get('selectedCategory'))
            ->get();

        return view('frontend.dashboard.item.create', compact('categories', 'selectedCategory', 'uploadedFiles'));
    }

    public function itemUploads(Request $request)
    {
        $categorySupportedExtensions = Category::find(session()->get('selectedCategory'))->file_types;
        $extensions = \Str::lower(implode(',', $categorySupportedExtensions));
        $request->validate([
            'file.*' => ['required', 'mimes:' . $extensions],
        ]);

        foreach ($request->file('file') as $file) {
            $fileInfo = $this->uploadFile($file, 'items');

            if ($fileInfo) {
                $uploadedFile = new UploadedFiles;
                $uploadedFile->author_id = auth()->id();
                $uploadedFile->category_id = session()->get('selectedCategory');
                $uploadedFile->name = $fileInfo['name'];
                $uploadedFile->extension = $fileInfo['extension'];
                $uploadedFile->mime_type = $fileInfo['mime_type'];
                $uploadedFile->path = $fileInfo['path'];
                $uploadedFile->size = $fileInfo['size'];
                $uploadedFile->save();
            }
        }

        $uploadedFiles = UploadedFiles::where('author_id', auth()->id())
            ->where('category_id', session()->get('selectedCategory'))
            ->get();

        $html = view('frontend.dashboard.item.partials.uploaded-files', compact('uploadedFiles'))->render();

        return response()->json(['files' => $uploadedFiles, 'html' => $html], 200);
    }

    public function uploadFile(UploadedFile $file, string $dir = 'uploads', string $disk = 'local'): ?array
    {
        if (! in_array($disk, ['public', 'local'])) {
            throw new \InvalidArgumentException("Invalid disk: $disk.");
        }

        try {
            $fileName = \Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs("uploads/{$dir}", $fileName, $disk);

            return [
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function itemDestroy(string $id): JsonResponse
    {
        $file = UploadedFiles::whereId($id)
            ->where('author_id', auth()->id())
            ->first();

        if (! $file) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        try {
            $this->deleteFile($file->path, 'local');
            $file->delete();

            $uploadedFiles = UploadedFiles::where('author_id', auth()->id())
                ->where('category_id', session()->get('selectedCategory'))
                ->get();

            return response()->json(['status' => 'success', 'message' => 'File removed successfully.', 'files' => $uploadedFiles]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 200);
        }
    }

    public function itemStore(ItemStoreRequest $request): JsonResponse
    {
        $item = new Item;
        $item->author_id = user()->id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->sub_category_id = $request->sub_category;
        $item->version = $request->version;
        $item->demo_link = $request->demo_link;
        $item->tags = explode(',', $request->tags);
        $item->preview_type = $request->preview_type;
        $item->preview_image = $request->preview_file;
        $item->preview_video = $request->preview_file;
        $item->preview_audio = $request->preview_file;
        $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
        $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
        $item->screenshots = $request->screenshots;
        $item->price = $request->price;
        $item->discount_price = $request->discount_price;
        $item->is_supported = $request->is_supported;
        $item->support_instruction = $request->support_instruction;
        $item->status = 'pending';
        $item->is_free = $request->is_free;
        $item->save();

        /* Move public files to public/uploads/items folder */
        $publicFiles = $request->screenshots ?? [];
        $publicFiles[] = $request->preview_file;
        foreach ($publicFiles as $file) {
            if (! $file) {
                continue;
            }

            $source = Storage::disk('local')->path($file);
            $destination = public_path('uploads/items/' . basename($file));
            if (File::exists($source)) {
                File::ensureDirectoryExists(public_path('uploads/items'));
                File::move($source, $destination);
            }
        }

        // stone initial history
        $itemHistory = new ItemHistory();
        $itemHistory->author_id = user()->id;
        $itemHistory->item_id = $item->id;
        $itemHistory->title = 'Initial Submission';
        $itemHistory->body = $request->message_for_reviewer;
        $itemHistory->status = 'pending';
        $itemHistory->save();

        UploadedFiles::where('author_id', user()->id)
            ->where('category_id', $item->category_id)?->delete();

        NotificationService::CREATED();

        return response()->json(['status' => 'success', 'redirect' => route('user.items.index')], 200);
    }

    public function itemEdit(string $id): View
    {
        $categories = Category::all();
        $item = Item::with(['category', 'subcategory'])->where('id', $id)->where('author_id', user()->id)->findOrFail($id);
        $uploadedFiles = UploadedFiles::where('author_id', auth()->id())
            ->where('category_id', $item->category_id)
            ->get();
        // put category_id on session
        session()->put('selectedCategory', $item->category->id);

        return view('frontend.dashboard.item.edit', compact('categories', 'item', 'uploadedFiles'));
    }

    public function itemUpdate(ItemUpdateRequest $request, string $id)
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        if ($item->status == 'pending' || $item->status == 'hard_rejected') return response()->json(['status' => 'error', 'message' => __('Item not approved yet.')]);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->version = $request->version;
        $item->demo_link = $request->demo_link;
        $item->tags = explode(',', $request->tags);
        if ($request->filled('preview_type')) {
            $item->preview_type = $request->preview_type;
        }
        if ($request->filled('preview_file')) {
            $item->preview_image = $request->preview_file;
        }
        if ($request->filled('preview_file')) {
            $item->preview_video = $request->preview_file;
        }
        if ($request->filled('preview_file')) {
            $item->preview_audio = $request->preview_file;
        }
        if ($request->filled('source_type')) {
            $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
        }
        if ($request->filled('source_type')) {
            $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
        }
        if ($request->filled('screenshots')) {
            $item->screenshots = $request->screenshots;
        }
        $item->price = $request->price;
        $item->discount_price = $request->discount_price;
        $item->is_supported = $request->is_supported;
        $item->support_instruction = $request->support_instruction;
        $item->status = 'resubmitted';
        $item->is_free = $request->is_free;
        $item->save();

        /* Move public files (preview_files, screenshots) to public/uploads/items folder */
        $publicFiles = $request->screenshots ?? [];
        $publicFiles[] = $request->preview_file;
        foreach ($publicFiles as $file) {
            if (! $file) {
                continue;
            }

            $source = Storage::disk('local')->path($file);
            $destination = public_path('uploads/items/' . basename($file));
            if (File::exists($source)) {
                File::ensureDirectoryExists(public_path('uploads/items'));
                File::move($source, $destination);
            }
        }

        UploadedFiles::where('author_id', user()->id)
            ->where('category_id', $item->category_id)?->delete();

        NotificationService::UPDATED();

        return response()->json(['status' => 'success', 'redirect' => route('user.items.index')], 200);
    }

    public function itemDownload(string $id)
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        if ($item->is_main_file_external) {
            return redirect()->away($item->main_file);
        }

        abort_unless(Storage::disk('local')->exists($item->main_file), 404, 'File not found.');

        return Storage::disk('local')->download($item->main_file, basename($item->main_file));
    }

    public function itemChangelog(string $id): View
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        return view('frontend.dashboard.item.changelog', compact('item'));
    }

    public function itemHistory(string $id): View
    {
        $histories = ItemHistory::where('item_id', $id)->latest()->get();
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();
        return view('frontend.dashboard.item.history', compact('item', 'histories'));
    }

    public function storeChangelog(Request $request, string $id): RedirectResponse
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        $request->validate([
            'version' => 'required|string|max:30',
            'description' => 'required|string|max:1000',
        ]);

        if ($item->status != 'approved') return abort(404);

        $changeLog = new ItemChangeLog();
        $changeLog->version = $request->version;
        $changeLog->description = $request->description;
        $changeLog->item_id = $item->id;
        $changeLog->save();

        NotificationService::UPDATED();

        return redirect()->back();
    }
}
