<?php

namespace App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Dashboard\Resources\ProjectCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectCommission extends EditRecord
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
