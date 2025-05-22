<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProjectCommissionResource\Pages;

use App\Filament\Dashboard\Resources\ProjectCommissionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProjectCommission extends CreateRecord
{
    protected static string $resource = ProjectCommissionResource::class;
}
