<?php

declare(strict_types=1);

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class OrderSummary extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.order-summary');
    }
}
