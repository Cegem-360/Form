<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteFunctionalityResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Resources\RequestQuoteFunctionalityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRequestQuoteFunctionality extends ViewRecord
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
