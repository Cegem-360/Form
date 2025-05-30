<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;

use App\Filament\Dashboard\Resources\ProjectCommissionResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewProjectCommission extends ViewRecord
{
    protected static string $resource = ProjectCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
