<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemStoreRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\UploadedFiles;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ItemController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $categories = Category::all();

        return view('frontend.dashboard.item.index', compact('categories'));
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
            'file.*' => ['required', 'mimes:'.$extensions],
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
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs("uploads/{$dir}", $fileName, $disk);

            return [
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => "uploads/{$dir}/{$fileName}",
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

        NotificationService::CREATED();

        return response()->json(['status' => 'success', 'redirect' => route('user.items.index')], 200);
    }
}
