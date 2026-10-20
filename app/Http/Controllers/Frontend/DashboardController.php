<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemReview;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('frontend.dashboard.index');
    }

    public function reviews(): View
    {
        $reviews = ItemReview::with('item')
            ->where('user_id', user()->id)
            ->latest()
            ->paginate(25);

        return view('frontend.dashboard.reviews.index', compact('reviews'));
    }
}
