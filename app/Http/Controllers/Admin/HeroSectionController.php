<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroSectionUpdateRequest;
use App\Models\HeroSection;
use App\Models\Item;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HeroSectionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage sections'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $hero = HeroSection::first();

        $featuredItemsOne = Item::select(['id', 'name'])
            ->whereIn('id', $hero->featured_items_one ?? [])
            ->get();

        $featuredItemsTwo = Item::select(['id', 'name'])
            ->whereIn('id', $hero->featured_items_two ?? [])
            ->get();

        return view('admin.sections.hero.index', compact('hero', 'featuredItemsOne', 'featuredItemsTwo'));
    }

    /**
     * Search approved items for the hero section featured item selects.
     */
    public function productSearch(Request $request): JsonResponse
    {
        $products = Item::with('author:id,name')
            ->select(['id', 'name', 'author_id', 'preview_type', 'preview_image', 'preview_video', 'preview_audio'])
            ->where('status', 'approved')
            ->where('name', 'like', "%{$request->q}%")
            ->paginate(20)
            ->withQueryString();

        return response()->json([
            'results' => $products->items(),
            'pagination' => [
                'more' => $products->hasMorePages(),
            ],
            'total_count' => $products->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeroSectionUpdateRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        HeroSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => $data['title'],
                'subtitle' => $data['sub_title'],
                'featured_items_one' => $data['featured_items_one'] ?? [],
                'featured_items_two' => $data['featured_items_two'] ?? [],
            ]
        );

        NotificationService::UPDATED();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
