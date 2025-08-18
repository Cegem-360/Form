<?php

declare(strict_types=1);

namespace App\Livewire\Filament\Forms\GuestShowQuaotation\Actions;

use App\Enums\RolesEnum;
use App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Registration;
use App\Models\RequestQuote;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

final class RegisterAndOrder extends Component
{
    public static function make(array $data, Component $component): Action
    {
        return Action::make('registerAndOrderAction')
            ->label(__('Register and Order'))
            ->requiresConfirmation()
            ->modalHeading(__('Register'))
            ->modalSubmitActionLabel(__('Register'))
            ->modalCancelActionLabel(__('Cancel'))
            ->modalAlignment(Alignment::Center)
            ->fillForm(fn (): array => $component->form->getState())
            ->schema(Registration::make())
            ->action(function (array $data) use ($component) {
                $dataTmp = $component->form->getState();

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

                $component->form->model($requestQuote)->saveRelationships();

                Session::put('requestQuote', $requestQuote->id);

                return $component->redirect(route('cart.summary', ['requestQuote' => $requestQuote->id]));
            })
            ->color('success')
            ->icon('heroicon-o-paper-airplane');
    }
}
