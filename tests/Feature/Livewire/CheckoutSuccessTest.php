<?php

declare(strict_types=1);

use App\Livewire\Checkout\CheckoutSuccess;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(CheckoutSuccess::class)
        ->assertStatus(200);
});
