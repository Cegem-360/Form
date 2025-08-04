<?php

declare(strict_types=1);

namespace App\Filament\Admin\Clusters\RequestQuotes\Resources\RequestQuoteResource\Pages;

use App\Filament\Admin\Clusters\RequestQuotes\Resources\RequestQuoteResource;
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
