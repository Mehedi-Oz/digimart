<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemComment;
use App\Models\ItemReview;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Item::query();
        $query->with('author');
        $query->withCount(['sales', 'reviews']);
        $query->withAvg('reviews', 'stars');
        $query->where('status', 'approved');
        $query->when($request->filled('category'), function ($query) use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->whereSlug($request->category);
            });
        });
        $query->when($request->filled('search'), function ($query) use ($request) {
            $search = '%'.$request->string('search')->trim().'%';
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        });
        $query->when($request->filled('rating'), function ($query) use ($request) {
            $query->whereIn('id', ItemReview::query()
                ->select('item_id')
                ->groupBy('item_id')
                ->havingRaw('AVG(stars) >= ?', [(int) $request->input('rating')]));
        });

        $products = $query->paginate(12);

        $categories = Category::withCount(['items' => function ($query) {
            return $query->where('status', 'approved');
        }])->get();
        $productCount = Item::where('status', 'approved')->count();
        $productCountByRating = ItemReview::query()
            ->selectRaw('ROUND(stars) as rating, COUNT(*) as total')
            ->groupByRaw('ROUND(stars)')
            ->pluck('total', 'rating');

        return view('frontend.pages.products', compact('products', 'categories', 'productCount', 'productCountByRating'));
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
