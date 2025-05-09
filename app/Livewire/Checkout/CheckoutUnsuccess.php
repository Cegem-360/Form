<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Models\Order;
use App\Models\RequestQuote;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Cashier;
use Livewire\Component;

final class CheckoutUnsuccess extends Component
{
    public ?string $sessionId = null;

    public ?Order $order = null;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {
        $this->requestQuote = $requestQuote;
        /* if (Session::missing('order')) {
            abort(403, 'Unauthorized action.');
        }

        $this->order = Order::find(Session::get('order')); */

    }

    public function render()
    {

        /*   $prices = Cashier::stripe()->prices->all();
          dump($prices); */

        // $session = Cashier::stripe()->checkout->sessions->retrieve($this->sessionId);

        /*     if ($session->payment_status != 'paid') {
                return $this->redirect(route('checkout-cancel'));
            } */

        return view('livewire.checkout.checkout-unsuccess');
    }
}
