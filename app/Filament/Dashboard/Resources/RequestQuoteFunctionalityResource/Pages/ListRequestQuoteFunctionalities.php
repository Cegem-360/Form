<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteFunctionalityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListRequestQuoteFunctionalities extends ListRecords
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
