<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Cashier\Cashier;
use Livewire\Component;

class CheckoutSuccess extends Component
{
    public ?string $sessionId = null;

    public function mount(Request $request): void
    {
        $this->sessionId = $request->get('session_id');
    }

    public function render(): JsonResponse|View|Response
    {

        if ($this->sessionId === null) {
            return view('livewire.checkout.checkout-success');
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($this->sessionId);

        if ($session->payment_status !== 'paid') {
            return view('livewire.checkout.checkout-success');
        }

        return view('livewire.checkout.checkout-success');
    }
}
