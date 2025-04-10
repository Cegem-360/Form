<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class CartSummary extends Component
{
    public $order;

    public function mount($record)
    {
        $this->order = $record; // Load order details
    }

    public function render()
    {
        return view('livewire.cart-summary', [
            'order' => $this->order,
        ]);
    }
}
