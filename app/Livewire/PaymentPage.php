<?php

declare(strict_types=1);

namespace App\Livewire;

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
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class PaymentPage extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public $order;

    public ?RequestQuote $requestQuote;

    public function mount(RequestQuote $requestQuote): void
    {
        dump($requestQuote);

        if (Auth::user()->id !== $requestQuote->user_id) {
            abort(403, 'Unauthorized action.');
        }

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

    public function payWithStripe(): Action
    {
        return Action::make('payWithStripe')
            ->action(function () {
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
                    'stripe_order_id' => Str::uuid()->toString(),
                    'amount' => $this->requestQuote->total_price,
                ]);

                Session::put('order', $order->id);

                return Auth::user()->checkoutCharge(($this->requestQuote->total_price / 2) * 100, 'Website Laravel', 1, [
                    'success_url' => route('checkout-success'),
                    'cancel_url' => route('checkout-cancel'),
                    'metadata' => [
                        'order_id' => $order->id,
                    ],
                ]);
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
                    'stripe_order_id' => Str::uuid()->toString(),
                    'amount' => $this->requestQuote->total_price,
                ]);

                Session::put('order', $order->id);

                $this->redirect(route('checkout-success'));
            });
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
