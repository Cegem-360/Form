<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

final class StripeWebhookController extends Controller
{
    /* public function handle(Request $request)
    {
        $payload = $request->getContent();
        $event = json_decode($payload);

        // Dump the full event for debugging
        Log::info('Stripe Webhook Event:', (array) $event);

        if (isset($event->type) && $event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $orderId = $session->metadata->order_id ?? null;
            $stripeSessionId = $session->id;
            $amountTotal = $session->amount_total ?? null;
            $currency = $session->currency ?? null;
            $customerEmail = $session->customer_details->email ?? null;
            $paymentStatus = $session->payment_status ?? null;

            Log::info('Stripe Session Details:', [
                'order_id' => $orderId,
                'stripe_session_id' => $stripeSessionId,
                'amount_total' => $amountTotal,
                'currency' => $currency,
                'customer_email' => $customerEmail,
                'payment_status' => $paymentStatus,
            ]);

            if ($orderId) {
                $order = Order::find($orderId);
                if ($order) {
                    $order->stripe_order_id = $stripeSessionId;
                    $order->status = 'paid'; // or your paid status
                    $order->save();
                }
            }
        }

        return Response::make('Webhook handled', 200);
    } */
}
