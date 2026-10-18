<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemComment;
use App\Models\ItemReview;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $query = Item::Query();
        $query->where('status', 'approved');
        $products = $query->get();

        return view('frontend.pages.products', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = Item::withCount(['comments', 'reviews', 'sales'])->where('slug', $slug)->whereStatus('approved')->firstOrFail();

        $comments = ItemComment::where('item_id', $product->id)->paginate();
        $reviews = ItemReview::where('item_id', $product->id)->paginate();

        $hasReviewed = auth()->check() && ItemReview::where('item_id', $product->id)->where('user_id', user()->id)->exists();

        return view('frontend.pages.product-details', compact('product', 'comments', 'reviews', 'hasReviewed'));
    }
}
