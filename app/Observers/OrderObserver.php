<?php

declare(strict_types=1);

namespace App\Observers;

use App\Mail\OrderTransactionDetailsMail;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

final class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if ($order->requestQuote) {
            $order->requestQuote->update(['is_payed' => true]);
        }
        Log::info('Order created', ['order_id' => $order->id, 'user_id' => $order->user_id, 'payment_method' => $order->payment_method]);
        if ($order->payment_method === 'bank_transfer') {
            Mail::to($order->user->email)->send(new OrderTransactionDetailsMail($order));
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
