<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Order;
use Laravel\Cashier\Cashier;
use Livewire\Component;
use Session;

class CheckoutSuccess extends Component
{
    public ?string $sessionId = null;

    public ?Order $order = null;

    public function mount(): void
    {
        if (Session::missing('order')) {
            abort(403, 'Unauthorized action.');
        }

        $this->order = Order::find(Session::get('order'));

    }

    public function render()
    {

        $prices = Cashier::stripe()->prices->all();
        dump($prices);

        // $session = Cashier::stripe()->checkout->sessions->retrieve($this->sessionId);

        /*     if ($session->payment_status != 'paid') {
                return $this->redirect(route('checkout-cancel'));
            } */

        return view('livewire.checkout.checkout-success');
    }
}
