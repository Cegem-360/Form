<?php

namespace App\Filament\Admin\Resources\ProjectCommissionResource\Pages;

use App\Filament\Admin\Resources\ProjectCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectCommission extends EditRecord
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
