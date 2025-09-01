<?php

declare(strict_types=1);

namespace App\Livewire\Filament\Forms\GuestShowQuaotation\Actions;

use App\Models\RequestQuote;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

final class Order extends Component
{
    public static function make(Component $component): Action
    {
        return Action::make('order')
            ->action(function () use ($component): void {
                $data = $component->form->getState();

                $data['user_id'] = Auth::id();
                unset($data['requestQuoteFunctionalities'],$data['consent'], $data['privacy_policy']);
                $requestQuote = RequestQuote::query()->create($data);
                if (isset($component->form->getState()['requestQuoteFunctionalities'])) {
                    $requestQuote->requestQuoteFunctionalities()->sync($component->form->getState()['requestQuoteFunctionalities']);
                }

                $component->form->model($requestQuote)->saveRelationships();
                // save to session
                Session::put('requestQuote', $requestQuote->id);
                $component->redirect(route('cart.summary', ['requestQuote' => $requestQuote->id]));
            })
            ->label(__('Order'))
            ->color('primary')
            ->icon('heroicon-o-paper-airplane');
    }
}
