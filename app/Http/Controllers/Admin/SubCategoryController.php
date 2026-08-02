<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryStoreRequest;
use App\Http\Requests\Admin\SubCategoryUpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class SubCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage categories'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sub_categories = SubCategory::paginate(25);

        return view('admin.category.sub-category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.category.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        SubCategory::create($data);
        NotificationService::UPDATED();

        return to_route('admin.sub-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();

        return view('admin.category.sub-category.edit', compact('categories', 'sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $sub_category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $sub_category->update($data);
        NotificationService::UPDATED();

        return to_route('admin.sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        try {
            $sub_category->delete();

            NotificationService::DELETED();

            return response()->json(['status' => 'success', 'message' => __('Deleted Successful')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }
    }
}
