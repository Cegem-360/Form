<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Models\RequestQuote;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class CheckoutUnsuccess extends Component
{
    public ?string $sessionId = null;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {
        $this->requestQuote = $requestQuote;
    }

    public function render(): View|Factory
    {
        return view('livewire.checkout.checkout-unsuccess');
    }
}
