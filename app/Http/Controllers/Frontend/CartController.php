<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Item;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cartItems = CartItem::with('item.category', 'item.subCategory')->where('user_id', user()->id)->get();

        return view('frontend.pages.cart', compact('cartItems'));
    }

    public function store(string $id): JsonResponse
    {
        $item = Item::where('id', $id)->where('status', 'approved')->first();

        if (! $item) {
            return response()->json([
                'status' => 'error',
                'message' => __('Item not found or not approved.'),
            ], 404);
        } elseif (CartItem::where('item_id', $id)->where('user_id', user()->id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => __('Item already in cart.'),
            ], 400);
        } elseif ($item->author_id == user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => __('You cannot add your own item to cart.'),
            ], 400);
        }

        $cart = new CartItem;
        $cart->item_id = $id;
        $cart->user_id = user()->id;
        $cart->save();

        $cartCount = CartItem::where('user_id', user()->id)->count();

        return response()->json(['status' => 'success', 'message' => __('Item added to cart successfully.'), 'cartCount' => $cartCount], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        if ($cartItems = CartItem::where('id', $id)->where('user_id', user()->id)->doesntExist()) {
            return response()->json([
                'status' => 'error',
                'message' => __('Item not found in cart.'),
            ], 404);
        }
        CartItem::where('id', $id)->where('user_id', user()->id)->delete();

        NotificationService::CREATED('Item removed from cart.');

        return response()->json(['status' => 'success', 'message' => __('Item removed from cart successfully.')], 200);
    }
}
