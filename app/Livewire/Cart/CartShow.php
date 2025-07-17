<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use Filament\Schemas\Schema;
use App\Models\RequestQuote;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class CartShow extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public ?int $total = 0;

    public ?RequestQuote $requestQuote = null;

    public function mount(RequestQuote $requestQuote): void
    {

        $this->requestQuote = $requestQuote;

        $this->total += $this->requestQuote?->getTotalPriceAttribute();
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

            ])
            ->statePath('data');
    }

    public function checkout(): void
    {
        $this->redirect(route('checkout.summary', ['requestQuote' => $this->requestQuote]));
    }

    public function render(): View
    {
        return view('livewire.cart.cart-show');
    }
}
