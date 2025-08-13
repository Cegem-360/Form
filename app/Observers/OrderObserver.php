<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\ProjectStatus;
use App\Mail\OrderTransactionDetailsMail;
use App\Models\Order;
use App\Models\Project;
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

        if ($order->requestQuote->payment_method === 'bank_transfer') {
            Mail::to($order->user->email)->send(new OrderTransactionDetailsMail($order));
        }

        Project::create([
            'request_quote_id' => $order->requestQuote->id,
            'user_id' => $order->user->id,
            'name' => $order->requestQuote->quotation_name,
            'start_date' => now(),
            'end_date' => now()->addDays(30), // Example: 30 days from now
            'status' => ProjectStatus::PENDING,
        ]);

    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(): void
    {
        //
    }
}
