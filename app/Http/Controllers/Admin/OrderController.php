<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Purchase::with(['user:id,name', 'transaction', 'purchaseItems'])->paginate(25);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id): View
    {
        $order = Purchase::with([
            'user:id,name',
            'transaction',
            'purchaseItems.item.author:id,name',
        ])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
