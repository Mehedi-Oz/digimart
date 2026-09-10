<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AuthorSale;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(): View
    {
        $purchases = PurchaseItem::with(['item.category', 'item.subcategory'])
            ->where('user_id', user()->id)
            ->paginate(25);

        return view('frontend.dashboard.orders.index', compact('purchases'));
    }

    public function show(string $id): View
    {
        $purchaseItem = PurchaseItem::where('id', $id)
            ->where('user_id', user()->id)
            ->firstOrFail();

        $purchase = $purchaseItem->purchase()
            ->with(['transaction', 'purchaseItems.item.author'])
            ->firstOrFail();

        return view('frontend.dashboard.orders.show', compact('purchase', 'purchaseItem'));
    }

    public function transactions(): View
    {
        $transactions = Transaction::where('user_id', user()->id)->latest()->paginate(25);

        return view('frontend.dashboard.orders.transaction', compact('transactions'));
    }

    public function sales(): View
    {
        abort_if(! isAuthor(), 403);

        $sales = AuthorSale::with(['item.category', 'item.subcategory'])
            ->where('author_id', user()->id)
            ->latest()
            ->paginate(25);

        return view('frontend.dashboard.orders.sales', compact('sales'));
    }

    public function download(string $id)
    {
        $purchaseItem = PurchaseItem::where('id', $id)
            ->where('user_id', user()->id)
            ->firstOrFail();

        $item = $purchaseItem->item;

        if ($item->is_main_file_external) {
            return redirect()->away($item->main_file);
        }

        abort_unless(Storage::disk('local')->exists($item->main_file), 404, 'File not found.');

        return Storage::disk('local')->download($item->main_file, basename($item->main_file));
    }
}
