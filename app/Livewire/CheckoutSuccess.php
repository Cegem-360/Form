<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Cashier\Cashier;
use Livewire\Component;

class CheckoutSuccess extends Component
{
    public ?string $sessionId = null;

    public ?Order $order = null;

    public function mount(Request $request): void
    {
        dump($request->all());
        $this->sessionId = $request->get('session_id');
    }

    public function render(): JsonResponse|View|Response
    {

        $prices = Cashier::stripe()->prices->all();
        dump($prices);

        if ($this->sessionId === null) {
            return view('livewire.checkout.checkout-unsuccess');
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($this->sessionId);

        if ($session->payment_status != 'paid') {
            return view('livewire.checkout.checkout-unsuccess', [
                'error' => 'Payment not completed.',
            ]);
        }

        return view('livewire.checkout.checkout-success');
    }
}
