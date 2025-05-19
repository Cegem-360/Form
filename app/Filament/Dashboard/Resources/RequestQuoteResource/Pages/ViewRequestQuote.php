<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Session;

final class ViewRequestQuote extends ViewRecord
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('Order')
                ->label(__('Order'))
                ->action(function ($record) {
                    Session::put('requestQuote', $record->id);

                    return redirect()->route('cart.summary', ['requestQuote' => $record->id]);
                }),

        ];
    }
}
