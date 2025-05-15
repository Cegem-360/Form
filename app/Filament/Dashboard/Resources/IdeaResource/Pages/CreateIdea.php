<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\IdeaResource\Pages;

use App\Filament\Resources\Dashboard\IdeaResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateIdea extends CreateRecord
{
    protected static string $resource = IdeaResource::class;
}
