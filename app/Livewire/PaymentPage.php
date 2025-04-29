<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\RequestQuote;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class PaymentPage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $order;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {
        dump($requestQuote);

        $this->requestQuote = $requestQuote; // Load order details
        if (! $this->requestQuote) {
            abort(403, 'Unauthorized action.');
        }
        $this->form->fill([
            'requestQuote' => $this->requestQuote,
        ]);

    }

    public function submit(): void
    {
        $this->form->getState();

        //
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('requestQuote.name')
                    ->label('Name')
                    ->required(),
                TextInput::make('requestQuote.email')
                    ->label('Email')
                    ->required()
                    ->email(),
                TextInput::make('requestQuote.phone')
                    ->label('Phone')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function payWithStripe(): void
    {
        // Handle Stripe payment logic here
    }

    public function finalizeOrder(): void
    {
        // Handle order finalization logic here
    }

    public function updateCustomerData()
    {
        $this->validate([
            'requestQuote.name' => 'required|string',
            'requestQuote.email' => 'required|email',
            'requestQuote.phone' => 'nullable|string',
        ]);
        $this->requestQuote->save();
        session()->flash('message', 'A rendelő adatai frissítve lettek.');
    }

    public function render()
    {
        return view('livewire.payment-page');
    }
}
