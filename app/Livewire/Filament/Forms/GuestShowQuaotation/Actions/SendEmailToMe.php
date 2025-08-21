<?php

declare(strict_types=1);

namespace App\Livewire\Filament\Forms\GuestShowQuaotation\Actions;

use App\Mail\QuotationSendedToUser;
use App\Models\RequestQuote;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

final class SendEmailToMe extends Component
{
    public static function make(array $data, Component $component): Action
    {
        return Action::make('sendEmailToMeAction')
            ->action(function () use ($data, $component): void {
                $data = $component->form->getState();
                unset($data['requestQuoteFunctionalities'],$data['consent'], $data['privacy_policy']);
                $record = RequestQuote::query()->create($data);
                Notification::make()
                    ->title('Quotation created and email sent')
                    ->success()
                    ->send();

                Mail::to($data['email'])->send(new QuotationSendedToUser($record));
                $component->redirect(route('email-sended-to-user'));
            })
            ->label(__('Send email to me'))
            ->color('success')
            ->icon('heroicon-o-envelope');

    }
}
