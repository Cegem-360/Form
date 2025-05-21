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
use Filament\Forms\Components\Checkbox;
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

        // $this->requestQuote = $requestQuote; // Load order details
        $data = $requestQuote?->toArray() ?? [];
        $data['company_vat_number'] = Auth::user()->company_vat_number;
        $this->form->fill($data);

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
                    ->options(ClientType::class),
                TextInput::make('billing_address')
                    ->label('Billing Address')
                    ->translateLabel()
                    ->live()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL->value),
                TextInput::make('company_name')
                    ->translateLabel()
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')
                    ->translateLabel()
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_vat_number')
                    ->translateLabel()
                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                Select::make('payment_method')
                    ->translateLabel()
                    ->label('Payment Method')
                    ->options([
                        'stripe' => 'Stripe',
                        'bank_transfer' => __('Bank Transfer'),
                    ])
                    ->default('stripe')
                    ->afterStateUpdated(function ($state): void {
                        $this->requestQuote->payment_method = $state;
                        $this->requestQuote->save();
                    })
                    ->required()
                    ->live(),
                Checkbox::make('terms')
                    ->label(__('I have read and accept the terms and conditions'))
                    ->required()
                    ->translateLabel()
                    ->live(),
                Checkbox::make('privacy')
                    ->label(__('I have read and accept the privacy policy'))
                    ->required()
                    ->translateLabel()
                    ->live(),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function payWithStripe(): Action
    {
        return Action::make('payWithStripe')
            ->extraAttributes(['class' => '!bg-[#2563eb]'])
            ->action(function () {
                $this->validate([
                    'data.name' => ['required', 'string'],
                    'data.email' => ['required', 'email'],
                    'data.phone' => ['nullable', 'string'],
                    'data.client_type' => ['required', 'string'],
                    'data.company_name' => ['nullable', 'string'],
                    'data.company_address' => ['nullable', 'string'],
                    'data.company_registration_number' => ['nullable', 'string'],
                    'data.payment_method' => ['required', 'string'],
                    'data.terms' => ['accepted'],
                    'data.privacy' => ['accepted'],
                ]);

                $this->requestQuote->update($this->data);
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
                    name: $this->requestQuote->websiteType->name. " ". $this->requestQuote->website_engine,
                    quantity: 1,
                    sessionOptions: [
                        'success_url' => route('checkout.success', ['requestQuote' => $this->requestQuote->id]),
                        'cancel_url' => route('checkout.unsuccess', ['requestQuote' => $this->requestQuote->id]),
                        'metadata' => [
                            'order_id' => $order->id,
                        ],
                    ],
                );

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
                    'data.client_type' => ['required', 'string'],
                    'data.company_name' => ['nullable', 'string'],
                    'data.company_address' => ['nullable', 'string'],
                    'data.company_registration_number' => ['nullable', 'string'],
                    'data.payment_method' => ['required', 'string'],
                    'data.terms' => ['accepted'],
                    'data.privacy' => ['accepted'],
                ]);
                $this->requestQuote->update($this->data);
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

                $this->redirect(route('checkout.success', ['requestQuote' => $this->requestQuote->id]));
            });
    }

    /* public function updateCustomerData(): void
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
    } */

    public function render()
    {
        return view('livewire.checkout.payment-page');
    }
}
