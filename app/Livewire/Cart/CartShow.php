<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\RequestQuote;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartShow extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public ?int $total = 0;

    public ?string $paymentMethod = null;

    public ?string $paymentMethodId = null;

    public ?RequestQuote $requestQuote = null;

    public function mount(): void
    {
        if (! Session::exists('requestQuote')) {
            abort(403, 'Unauthorized action.');
        }
        $this->requestQuote = RequestQuote::find(Session::get('requestQuote'));
        collect($this->requestQuote->websites)->each(function ($page) use (&$total) {
            $this->total += match ($page['length']) {
                'short' => 20000,
                'medium' => 40000,
                'long' => 70000,
            };
        });
        $this->total += $this->requestQuote->requestQuoteFunctionalities->sum('price');

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ])
            ->statePath('data');
    }

    public function submitAction(): Action
    {
        return Action::make('submit')
            ->label('Submit')
            ->action(function () {
                return Auth::user()->checkoutCharge($this->total * 100, 'Árajánlat', 1, [
                    'success_url' => route('checkout-success'),
                    'cancel_url' => route('checkout-cancel'),
                ]);
            })
            ->color('primary');
    }

    public function render(): View
    {
        return view('livewire.cart.cart-show');
    }
}
