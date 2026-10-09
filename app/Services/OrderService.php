<?php

namespace App\Services;

use App\Models\AuthorSale;
use App\Models\CartItem;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use App\Models\User;

class OrderService
{
    public static function storeOrder(
        string $paymentId,
        string $paidInAmount,
        string $paidInCurrencyIcon,
        string $exchangeRate,
        string $paymentGateway
    ) {
        /* store order */
        $purchase = new Purchase;
        $purchase->user_id = user()->id;
        $purchase->code = 'ORD-'.time().rand(1, 9999);
        $purchase->status = 'completed';
        $purchase->save();

        /* store order items */
        foreach (getCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->purchase_key = uniqid();
            $purchaseItem->purchase_id = $purchase->id;
            $purchaseItem->author_id = $cartItem->item->author_id;
            $purchaseItem->user_id = user()->id;
            $purchaseItem->item_id = $cartItem->item->id;
            $purchaseItem->price = $cartItem->item->discount_price > 0 ? $cartItem->item->discount_price : $cartItem->item->price;
            $purchaseItem->quantity = 1;
            $purchaseItem->total = $cartItem->item->price;
            $purchaseItem->save();
        }

        /* store transaction */
        $transaction = new Transaction;
        $transaction->user_id = user()->id;
        $transaction->purchase_id = $purchase->id;
        $transaction->payment_id = $paymentId;
        $transaction->payment_gateway = $paymentGateway;
        $transaction->paid_amount = getCartTotal();
        $transaction->paid_in_amount = $paidInAmount;
        $transaction->paid_in_currency_icon = $paidInCurrencyIcon;
        $transaction->exchange_rate = $exchangeRate;
        $transaction->status = 'completed';
        $transaction->save();

        /* author commission */
        foreach (getCartItems() as $cartItem) {
            $amount = $cartItem->item->discount_price > 0 ? $cartItem->item->discount_price : $cartItem->item->price;
            $sale = new AuthorSale;
            $sale->author_id = $cartItem->item->author_id;
            $sale->user_id = user()->id;
            $sale->item_id = $cartItem->item->id;
            $sale->amount = $amount;
            $sale->author_commission_rate = config('settings.author_commission');
            $sale->author_earning = $amount * (config('settings.author_commission') / 100);
            $sale->save();

            /* update author balance */
            $author = User::where('id', $cartItem->item->author_id)->first();
            $author->balance += $sale->author_earning;
            $author->save();
        }

        /* clear cart */
        CartItem::where('user_id', user()->id)->delete();
    }
}
