<?php

use App\Livewire\CheckoutSuccess;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(CheckoutSuccess::class)
        ->assertStatus(200);
});
