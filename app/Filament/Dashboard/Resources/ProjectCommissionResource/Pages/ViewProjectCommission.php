<?php

namespace App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Dashboard\Resources\ProjectCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectCommission extends ViewRecord
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
