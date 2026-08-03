<?php

namespace App\Http\Controllers\Admin;

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

    public function create(Request $request)
    {
        $category = Category::whereSlug($request->category)->firstOrFail();
        
        return view('frontend.dashboard.item.create');
    }
}
