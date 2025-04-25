<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class PaymentPage extends Component
{
    public $order;

    public function mount($record): void
    {
        $this->order = $record; // Load order details
    }

    public function payWithStripe(): void
    {
        // Handle Stripe payment logic here
    }

    public function finalizeOrder(): void
    {
        // Handle order finalization logic here
    }

    public function render()
    {
        return view('livewire.payment-page', [
            'order' => $this->order,
        ]);
    }
}
