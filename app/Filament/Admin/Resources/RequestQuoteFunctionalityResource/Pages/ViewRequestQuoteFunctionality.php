<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewRequestQuoteFunctionality extends ViewRecord
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
