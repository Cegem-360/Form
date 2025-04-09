<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Resources\RequestQuoteFunctionalityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestQuoteFunctionalities extends ListRecords
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
