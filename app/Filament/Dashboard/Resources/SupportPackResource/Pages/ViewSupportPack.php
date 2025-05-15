<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\SupportPackResource\Pages;

use App\Filament\Dashboard\Resources\SupportPackResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewSupportPack extends ViewRecord
{
    protected static string $resource = SupportPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
