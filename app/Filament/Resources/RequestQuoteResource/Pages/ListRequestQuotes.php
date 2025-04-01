<?php

namespace App\Filament\Resources\RequestQuoteResource\Pages;

use App\Filament\Resources\RequestQuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestQuotes extends ListRecords
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
