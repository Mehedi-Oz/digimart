<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('frontend.dashboard.item.index', compact('categories'));
    }

    public function create(Request $request): View
    {
        $categories = Category::all();
        $selected_category = Category::with('subcategories')->whereSlug($request->category)->firstOrFail();

        return view('frontend.dashboard.item.create', compact('categories', 'selected_category'));
    }

    public function itemUploads(Request $request)
    {
        dd($request->all());
    }
}
