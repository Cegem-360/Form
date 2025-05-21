<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Models\Order;
use App\Enums\RolesEnum;
use Livewire\Component;
use App\Models\RequestQuote;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $this->order = Order::firstOrcreate([
            'request_quote_id' => $requestQuote->id,
            'user_id' => $requestQuote->user_id,
            'amount' => $requestQuote->getTotalPriceAttribute(),
            'status' => TransactionStatus::PENDING,

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
