<?php

use App\Livewire\CheckoutSuccess;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CheckoutSuccess::class)
        ->assertStatus(200);
});
