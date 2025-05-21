<?php

namespace App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;

use App\Filament\Dashboard\Resources\ProjectCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectCommissions extends ListRecords
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
