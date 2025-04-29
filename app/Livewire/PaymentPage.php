<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\RequestQuote;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Notification;

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
            'name' => $this->requestQuote->name,
            'email' => $this->requestQuote->email,
            'phone' => $this->requestQuote->phone,
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
                TextInput::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->live()
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->translateLabel()
                    ->required()
                    ->live()
                    ->email(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->translateLabel()
                    ->live()
                    ->required(),
                Select::make('paymentMethod')
                    ->translateLabel()
                    ->label('Payment Method')
                    ->options([
                        'stripe' => 'Stripe',
                        'bank_transfer' => 'Bank Transfer',
                    ])
                    ->default('stripe')
                    ->required()
                    ->live(),
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

    public function updateCustomerData(): void
    {
        $this->validate([
            'data.name' => ['required', 'string'],
            'data.email' => ['required', 'email'],
            'data.phone' => ['nullable', 'string'],
        ]);
        $this->requestQuote->save();
        Notification::make()
            ->title(__('Customer data updated successfully'))
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.payment-page');
    }
}
