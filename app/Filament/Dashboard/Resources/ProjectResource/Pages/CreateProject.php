<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProjectResource\Pages;

use App\Filament\Dashboard\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
