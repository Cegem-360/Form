<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\RequestQuote;
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

        $this->order = Order::firstOrcreate([
            'request_quote_id' => $requestQuote->id,
            'user_id' => $requestQuote->user_id,
            'amount' => $requestQuote->getTotalPriceAttribute(),
            'status' => TransactionStatus::PENDING,

        ]);
        Session::forget('request_quote');
    }

    public function render()
    {

        return view('livewire.checkout.checkout-success');
    }
}
