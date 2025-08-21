<?php

declare(strict_types=1);

use App\Livewire\GuestShowQuaotationForm;
use Livewire\Livewire;

it('renders the livewire component', function (): void {
    Livewire::test(GuestShowQuaotationForm::class)
        ->assertStatus(200)
        ->assertSee('Weboldal típusa');
});
