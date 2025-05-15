<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Filament\Resources\Admin\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
