<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteResource;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Widgets\RequestQuotePriceWidget;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Session;

final class ViewRequestQuote extends ViewRecord
{
    protected static string $resource = RequestQuoteResource::class;

    public function createPdf()
    {
        $record = $this->record;

        return redirect()->route('quotation.preview', ['requestQuote' => $record->id]);
    }

    protected function getHeaderActions(): array
    {
        return [

            Action::make('Order')
                ->visible(fn ($record): bool => $record->is_payed === false)
                ->label(__('Order'))
                ->action(function ($record) {
                    Session::put('requestQuote', $record->id);

                    return redirect()->route('cart.summary', ['requestQuote' => $record->id]);
                }),
            Action::make('createPdf')
                ->label('Árajánlat megtekintése')
                ->action('createPdf')
                ->color('primary'),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RequestQuotePriceWidget::class,
        ];
    }
}
