<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\ClientInformation;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\Consent;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\GraphicsInformation;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\WebsiteInformation;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\CreateRequestQuote;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\Order;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\RegisterAndOrder;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\RegisterAndSend;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\SendEmailToMe;
use App\Models\RequestQuote;
use App\Models\RequestQuoteFunctionality;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class GuestShowQuaotationForm extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public RequestQuoteFunctionality $requestQuoteFunctionality;

    public function mount(): void
    {
        if (Auth::check()) {
            $this->data['name'] = Auth::user()->name;
            $this->data['email'] = Auth::user()->email;
            $this->data['phone'] = Auth::user()->phone;
            $this->data['company_name'] = Auth::user()->company_name;
            $this->data['company_address'] = Auth::user()->company_address;
            $this->data['company_vat_number'] = Auth::user()->company_vat_number;
        }

        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    ClientInformation::make(),
                    WebsiteInformation::make(),
                    GraphicsInformation::make(),
                    Consent::make(),
                ])
                    ->skippable(false)
                    ->submitAction($this->submitButtonAction()),
            ])
            ->statePath('data')
            ->model(RequestQuote::class);
    }

    public function submitButtonAction(): Action
    {
        $form = $this->data;

        return Action::make('submit')
            ->view('filament.forms.components.quotation-submit-button', ['data' => $form]);
    }

    public function createRequestQuoteAction(): Action
    {
        return CreateRequestQuote::make($this);
    }

    public function orderAction(): Action
    {
        return Order::make($this);
    }

    public function registerAndSendAction(): Action
    {
        return RegisterAndSend::make($this->form->getState(), $this);
    }

    public function registerAndOrderAction(): Action
    {
        return RegisterAndOrder::make($this->form->getState(), $this);
    }

    public function sendEmailToMeAction(): Action
    {
        return SendEmailToMe::make($this->form->getState(), $this);
    }

    public function create(): void
    {
        /*  dd($this->form->getState()); */
    }

    public function render(): View
    {
        return view('livewire.quotations.guest-show-form');
    }
}
