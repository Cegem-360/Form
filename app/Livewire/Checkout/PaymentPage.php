<?php

declare(strict_types=1);

namespace App\Livewire\Checkout;

use App\Enums\ClientType;
use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use App\Livewire\Filament\Forms\Schemas\PaymentPageForm;
use App\Models\Order;
use App\Models\RequestQuote;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
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

        $data = $requestQuote?->toArray() ?? [];
        $data['company_vat_number'] = Auth::user()->company_vat_number;
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $data['phone'] = Auth::user()->phone;
        $data['client_type'] = Auth::user()->client_type ?? ClientType::INDIVIDUAL->value;
        $this->form->fill($data);

    }

    public function form(Schema $schema): Schema
    {
        return PaymentPageForm::configure($schema, $this->requestQuote);
    }

    public function payWithStripe(): Action
    {
        return Action::make('payWithStripe')
            ->extraAttributes(['class' => 'bg-[#2563eb]!'])
            ->action(function () {
                $data = $this->form->getState();
                unset($data['terms'], $data['privacy']);
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
                unset($data['terms'],$data['privacy']);
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

                $order = Order::query()->firstOrCreate([
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

    public function render()
    {
        return view('livewire.checkout.payment-page');
    }
}
