<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Pages;

use App\Filament\Resources\Admin\RequestQuoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListRequestQuotes extends ListRecords
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
