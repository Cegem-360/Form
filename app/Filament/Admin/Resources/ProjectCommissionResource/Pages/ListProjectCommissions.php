<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectCommissionResource\Pages;

use App\Filament\Admin\Resources\ProjectCommissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListProjectCommissions extends ListRecords
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
