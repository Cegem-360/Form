<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Enums\RolesEnum;
use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\RequestQuote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

/**
 * @var Order $order
 * @var RequestQuote $requestQuote
 */
final class CheckoutSuccess extends Component
{
    public ?string $sessionId = null;

    public ?Order $order = null;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {

        $this->requestQuote = $requestQuote;

        $this->order = Order::whereRequestQuoteId($requestQuote->id)
            ->whereUserId($requestQuote->user->id)
            ->firstOrFail();
        $this->order->update([
            'request_quote_id' => $requestQuote->id,
            'user_id' => $requestQuote->user->id,
            'customer_name' => $requestQuote->user->name,
            'customer_email' => $requestQuote->user->email,
            'amount' => $requestQuote->getTotalPriceAttribute(),
            'status' => $requestQuote->payment_method === 'stripe'
                ? TransactionStatus::COMPLETED
                : TransactionStatus::PENDING,
            'currency' => StripeCurrency::HUF,
        ]);
        Session::forget('request_quote');
        if (Auth::user()->hasRole(RolesEnum::GUEST)) {
            Auth::user()->removeRole(RolesEnum::GUEST);
            Auth::user()->assignRole(RolesEnum::USER);
        }
    }

    public function render()
    {

        return view('livewire.checkout.checkout-success');
    }
}
