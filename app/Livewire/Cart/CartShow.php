<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\RequestQuote;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        collect($this->requestQuote->websites)->each(function (array $page) use (&$total): void {
            if ($page['required']) {
                $this->total += match ($page['length']) {
                    'short' => 20000,
                    'medium' => 40000,
                    'long' => 70000,
                };
            }
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
                if (! Auth::check()) {
                    $user = User::create([
                        'name' => $this->requestQuote->name,
                        'email' => $this->requestQuote->email,
                        'phone' => $this->requestQuote->phone,
                        'company_name' => $this->requestQuote->company_name,
                        'company_address' => $this->requestQuote->company_address,
                        'company_vat_number' => $this->requestQuote->company_vat_number,
                        'company_registration_number' => $this->requestQuote->company_registration_number,
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                    ]);
                    $user->assignRole('user');
                    Auth::login($user);

                }

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
