<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Enums\ClientType;
use App\Enums\StripeCurrency;
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
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class PaymentPage extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public ?Order $order;

    public ?RequestQuote $requestQuote;

    public function mount(?RequestQuote $requestQuote = null): void
    {

        // $this->requestQuote = $requestQuote; // Load order details
        $data = $requestQuote?->toArray() ?? [];
        $data['company_vat_number'] = Auth::user()->company_vat_number;
        $this->form->fill($data);

    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')

                    ->live()
                    ->required(),
                TextInput::make('email')
                    ->label('Email')

                    ->required()
                    ->live()
                    ->email(),
                TextInput::make('phone')
                    ->label('Phone')

                    ->live()
                    ->required(),
                Select::make('client_type')
                    ->label('Legal form')

                    ->live()
                    ->required()
                    ->options(ClientType::class),
                TextInput::make('billing_address')
                    ->label('Billing Address')

                    ->live()
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::INDIVIDUAL->value),
                TextInput::make('company_name')

                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_address')

                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                TextInput::make('company_vat_number')

                    ->live(condition: fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->visible(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->required(fn (Get $get): bool => $get('client_type') === ClientType::COMPANY->value)
                    ->maxLength(255),
                Select::make('payment_method')

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
                    ->accepted()
                    ->default(false)

                    ->live(),
                Checkbox::make('privacy')
                    ->label(__('I have read and accept the privacy policy'))
                    ->required()
                    ->accepted()
                    ->default(false)

                    ->live(),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function payWithStripe(): Action
    {
        return Action::make('payWithStripe')
            ->extraAttributes(['class' => 'bg-[#2563eb]!'])
            ->action(function () {
                $data = $this->form->getState();

                $this->requestQuote->update($data);
                Auth::user()->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'] ?? null,
                    'company_address' => $data['company_address'] ?? null,
                    'company_vat_number' => $data['company_vat_number'] ?? null,
                ]);
                Notification::make()
                    ->title(__('Order finalized successfully'))
                    ->success()
                    ->send();

                $order = Order::whereRequestQuoteId($this->requestQuote->id)->firstOrCreate([
                    'request_quote_id' => $this->requestQuote->id,
                    'user_id' => Auth::user()->id,
                    'status' => TransactionStatus::PENDING,
                    'currency' => StripeCurrency::HUF,
                    'amount' => $this->requestQuote->total_price,
                ]);

                Session::put('order', $order->id);

                return Auth::user()->checkoutCharge(
                    amount: ($this->requestQuote->total_price / 2) * 100,
                    name: $this->requestQuote->websiteType->name.' '.$this->requestQuote->website_engine,
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
                $data = $this->form->getState();

                $this->requestQuote->update($data);

                Auth::user()->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'company_name' => $data['company_name'] ?? null,
                    'company_address' => $data['company_address'] ?? null,
                    'company_vat_number' => $data['company_vat_number'] ?? null,
                ]);

                Notification::make()
                    ->title(__('Order finalized successfully'))
                    ->success()
                    ->send();

                $order = Order::firstOrCreate([
                    'request_quote_id' => $this->requestQuote->id,
                    'user_id' => Auth::user()->id,
                ], [
                    'request_quote_id' => $this->requestQuote->id,
                    'user_id' => Auth::user()->id,
                    'status' => TransactionStatus::PENDING,
                    'currency' => StripeCurrency::HUF,
                    'amount' => $this->requestQuote->getTotalPriceAttribute(),
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
