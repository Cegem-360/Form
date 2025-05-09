<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\RequestQuote;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class CartShow extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?array $data = [];

    public ?int $total = 0;

    public ?RequestQuote $requestQuote = null;

    public function mount(RequestQuote $requestQuote): void
    {
        $this->requestQuote = $requestQuote;

        /* if (! Session::exists('requestQuote') && Auth::user()->id !== $requestQuote->user_id) {
            abort(403, 'Unauthorized action.');
        } */
        collect($this->requestQuote?->websites)->each(function (array $page) use (&$total): void {
            if ($page['required']) {
                $this->total += match ($page['length']) {
                    'short' => 20000,
                    'medium' => 40000,
                    'long' => 70000,
                };
            }
        });
        $this->total += $this->requestQuote?->requestQuoteFunctionalities->sum('price');

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ])
            ->statePath('data');
    }

    public function checkout(): void
    {
        $this->redirect(route('checkout.summary', ['requestQuote' => $this->requestQuote]));
    }

    public function render(): View
    {
        dump($this->requestQuote);

        return view('livewire.cart.cart-show');
    }
}
