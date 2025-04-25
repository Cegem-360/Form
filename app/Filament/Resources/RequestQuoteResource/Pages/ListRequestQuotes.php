<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\RequestQuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestQuotes extends ListRecords
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
