<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

final class ListRequestQuotes extends ListRecords
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label(__('New Request Quote'))
                ->icon('heroicon-o-plus')
                ->url(route('quotation')),
        ];
    }
}
