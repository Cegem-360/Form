<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\RequestQuote;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartShow extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?int $total = 0;

    public ?RequestQuote $requestQuote = null;

    public function mount(): void
    {
        if (! Session::exists('requestQuote')) {
            abort(403, 'Unauthorized action.');
        }
        $this->requestQuote = RequestQuote::find(Session::get('requestQuote'));
        dump($this->requestQuote);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Enter your name'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.cart.cart-show');
    }
}
