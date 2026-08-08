<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UploadedFiles;
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
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
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
}
