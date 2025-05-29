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

        $this->order = Order::firstOrCreate(
            [
                'request_quote_id' => $requestQuote->id,
                'user_id' => $requestQuote->user_id,
            ],
            [
                'request_quote_id' => $requestQuote->id,
                'user_id' => $requestQuote->user_id,
                'customer_name' => $requestQuote->user->name,
                'customer_email' => $requestQuote->user->email,
                'amount' => $requestQuote->getTotalPriceAttribute(),
                'status' => TransactionStatus::PENDING,
                'currency' => StripeCurrency::HUF,
            ]);
        Session::forget('request_quote');
        Auth::user()->removeRole(RolesEnum::GUEST);
        Auth::user()->assignRole(RolesEnum::USER);
    }

    public function render()
    {

        return view('livewire.checkout.checkout-success');
    }
}
