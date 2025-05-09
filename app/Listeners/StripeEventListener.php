<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

final class StripeEventListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {
        Log::info('Stripe Webhook Received:', [
            'payload' => $event->payload,
        ]);
        if ($event->payload['type'] === 'checkout.payment_succeeded') {
            Order::create([
                'request_quote_id' => $event->payload['data']['object']['metadata']['request_quote_id'],
            ]);
        }

    }
}
