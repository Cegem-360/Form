<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\RolesEnum;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Registration;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\ClientInformation;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\Consent;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\GraphicsInformation;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\WebsiteInformation;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\CreateRequestQuote;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\Order;
use App\Livewire\Filament\Forms\GuestShowQuaotation\Actions\SendEmailToMe;
use App\Models\RequestQuote;
use App\Models\RequestQuoteFunctionality;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
                    ->skippable()
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
        return CreateRequestQuote::make($this->form->getState(), $this);
    }

    public function orderAction(): Action
    {
        return Order::make($this->form->getState(), $this);
    }

    public function registerAndSendAction(): Action
    {
        return Action::make('registerAndSendAction')
            ->label(__('Register and Create Quotation'))
            ->requiresConfirmation()
            ->modalHeading(__('Register'))
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(function (): array {
                return $this->form->getState();
            })
            ->schema(Registration::make())
            ->action(function (array $data) {
                $fillDataForRegister = $data;
                $data = $this->form->getState();
                unset($data['requestQuoteFunctionalities'],$data['consent'], $data['privacy_policy']);
                $validatedfillDataForRegister = Validator::make($fillDataForRegister, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();

                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
                    'password' => Hash::make($validatedfillDataForRegister['password']),

                ]);
                $user->assignRole(RolesEnum::GUEST);
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $data['user_id'] = Auth::id();

                $requestQuote = RequestQuote::create($data);

                Notification::make()
                    ->title(__('Quotation created and order placed'))
                    ->success()
                    ->send();

                $this->form->model($requestQuote)->saveRelationships();

                Session::put('requestQuote', $requestQuote->id);

                return $this->redirect(route('filament.dashboard.pages.dashboard'));
            })
            ->color('success')
            ->icon('heroicon-o-paper-airplane');
    }

    public function registerAndOrderAction(): Action
    {
        return Action::make('registerAndOrderAction')
            ->label(__('Register and Order'))
            ->requiresConfirmation()
            ->modalHeading(__('Register'))
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(function (): array {
                return $this->form->getState();
            })
            ->schema(Registration::make())
            ->action(function (array $data) {
                $dataTmp = $this->form->getState();

                $validatedfillDataForRegister = Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                    'phone' => ['required', 'string', 'max:255'],
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'company_address' => ['nullable', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ])->validate();
                $user = User::create([
                    'name' => $validatedfillDataForRegister['name'],
                    'email' => $validatedfillDataForRegister['email'],
                    'phone' => $validatedfillDataForRegister['phone'],
                    'company_name' => $validatedfillDataForRegister['company_name'] ?? null,
                    'company_address' => $validatedfillDataForRegister['company_address'] ?? null,
                    'password' => Hash::make($validatedfillDataForRegister['password']),
                ]);
                unset($dataTmp['requestQuoteFunctionalities'],$dataTmp['consent'], $dataTmp['privacy_policy']);
                $user->assignRole(RolesEnum::GUEST);
                event(new Registered($user));
                Auth::loginUsingId($user->id, true);
                $dataTmp['user_id'] = Auth::id();

                $requestQuote = RequestQuote::create($dataTmp);

                Notification::make()
                    ->title(__('Quotation created and order placed'))
                    ->success()
                    ->send();

                $this->form->model($requestQuote)->saveRelationships();

                Session::put('requestQuote', $requestQuote->id);

                return $this->redirect(route('cart.summary', ['requestQuote' => $requestQuote->id]));
            })
            ->color('success')
            ->icon('heroicon-o-paper-airplane');
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
