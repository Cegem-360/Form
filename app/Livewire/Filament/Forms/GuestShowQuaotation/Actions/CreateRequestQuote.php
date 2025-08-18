<?php

declare(strict_types=1);

namespace App\Livewire\Filament\Forms\GuestShowQuaotation\Actions;

use App\Models\RequestQuote;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class CreateRequestQuote extends Component
{
    public static function make(array $data, Component $component): Action
    {
        return Action::make('createRequestQuoteAction')
            ->action(function () use ($data, $component): void {

                $data['user_id'] = Auth::id();
                unset($data['requestQuoteFunctionalities'],$data['consent'], $data['privacy_policy']);
                $requestQuote = RequestQuote::create($data);
                $component->form->model($requestQuote)->saveRelationships();
                // save to session
                Session::put('requestQuote', $requestQuote->id);
                $component->redirect(route('filament.dashboard.resources.request-quotes.index'));
            })
            ->label(__('Create Request Quote'))
            ->color('primary')
            ->icon('heroicon-o-paper-airplane');
    }
}
