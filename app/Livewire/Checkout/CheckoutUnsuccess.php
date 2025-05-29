<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Models\RequestQuote;
use Livewire\Component;

final class CheckoutUnsuccess extends Component
{
    public ?string $sessionId = null;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {
        $this->requestQuote = $requestQuote;
    }

    public function render()
    {
        return view('livewire.checkout.checkout-unsuccess');
    }
}
