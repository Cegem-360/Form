<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Enums\ClientType;
use App\Enums\TransactionStatus;
use App\Models\Order;
use App\Models\RequestQuote;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class PaymentPage extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public $order;

    public ?RequestQuote $requestQuote;

    public function mount(?RequestQuote $requestQuote = null): void
    {
        /*
                if (Auth::user()->id !== $requestQuote->user_id) {
                    abort(403, 'Unauthorized action.');
                }

                $this->requestQuote = $requestQuote; // Load order details
                if (! $this->requestQuote) {
                    abort(403, 'Unauthorized action.');
                } */

        /* $this->form->fill([
            'name' => $this->requestQuote->name,
            'email' => $this->requestQuote->email,
            'phone' => $this->requestQuote->phone,
            'client_type' => $this->requestQuote->client_type,
            'company_name' => $this->requestQuote->company_name,
            'company_address' => $this->requestQuote->company_address,
            'company_registration_number' => $this->requestQuote->company_registration_number,
        ]); */
        $this->form->fill($this->requestQuote->toArray());

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
                Select::make('client_type')
                    ->label('Legal form')
                    ->translateLabel()
                    ->live()
                    ->required()
                    ->options(ClientType::class)
                    ->preload(),
                TextInput::make('company_name')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                TextInput::make('company_registration_number')
                    ->translateLabel()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY)
                    ->maxLength(255),
                Select::make('paymentMethod')
                    ->translateLabel()
                    ->label('Payment Method')
                    ->options([
                        'stripe' => 'Stripe',
                        'bank_transfer' => __('Bank Transfer'),
                    ])
                    ->default('stripe')
                    ->required()
                    ->live(),
            ])
            ->statePath('data')
            ->model($this->requestQuote);
    }

    public function payWithStripe(): Action
    {
        return Action::make('payWithStripe')
            ->action(function () {
                $this->validate([
                    'data.name' => ['required', 'string'],
                    'data.email' => ['required', 'email'],
                    'data.phone' => ['nullable', 'string'],
                    'data.client_type' => ['required', 'string'],
                    'data.company_name' => ['nullable', 'string'],
                    'data.company_address' => ['nullable', 'string'],
                    'data.company_registration_number' => ['nullable', 'string'],
                ]);

                $this->requestQuote->save();

                Notification::make()
                    ->title(__('Order finalized successfully'))
                    ->success()
                    ->send();

                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'status' => TransactionStatus::PENDING,
                    'request_quote_id' => $this->requestQuote->id,
                    'amount' => $this->requestQuote->total_price,
                ]);

                Session::put('order', $order->id);

                return Auth::user()->checkoutCharge(
                    amount: ($this->requestQuote->total_price / 2) * 100,
                    name: 'Website Laravel',
                    quantity: 1,
                    sessionOptions: [
                        'success_url' => route('checkout.success', ['requestQuote' => $this->requestQuote->id]),
                        'cancel_url' => route('checkout.unsuccess', ['requestQuote' => $this->requestQuote->id]),
                        'metadata' => [
                            'order_id' => $order->id,
                        ],
                    ],/*
                    customerOptions: [
                        'customer_details' => [
                            'address' => [
                                'city' => 'Budapest',
                                'country' => 'HU',
                                'line1' => null,
                                'line2' => null,
                                'postal_code' => null,
                                'state' => null,
                            ],
                            'email' => 'admin@admin.com',
                            'name' => 'Szabó Zoltán',
                            'phone' => null,
                            'tax_exempt' => 'none',
                            'tax_ids' => [],
                        ],
                    ] */
                );
                // dump('Payment initiated');

            })
            ->label(__('Pay with Stripe'));
    }

    public function finalizeOrder(): Action
    {
        return Action::make('finalizeOrder')
            ->label(__('Finalize Order'))
            ->action(function (): void {
                $this->validate([
                    'data.name' => ['required', 'string'],
                    'data.email' => ['required', 'email'],
                    'data.phone' => ['nullable', 'string'],
                ]);

                $this->requestQuote->save();

                Notification::make()
                    ->title(__('Order finalized successfully'))
                    ->success()
                    ->send();
                Session::forget('requestQuote');

                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'status' => TransactionStatus::PENDING,
                    'request_quote_id' => $this->requestQuote->id,
                    'amount' => $this->requestQuote->total_price,
                ]);

                Session::put('order', $order->id);

                $this->redirect(route('checkout.success'));
            });
    }

    public function updateCustomerData(): void
    {
        $this->validate([
            'data.name' => ['required', 'string'],
            'data.email' => ['required', 'email'],
            'data.phone' => ['nullable', 'string'],
            'data.client_type' => ['required', 'string'],
            'data.company_name' => ['nullable', 'string'],
            'data.company_address' => ['nullable', 'string'],
            'data.company_registration_number' => ['nullable', 'string'],
        ]);
        $this->requestQuote->save();
        Notification::make()
            ->title(__('Customer data updated successfully'))
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.checkout.payment-page');
    }
}
