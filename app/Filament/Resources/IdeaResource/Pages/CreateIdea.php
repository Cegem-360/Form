<?php

declare(strict_types=1);

namespace App\Filament\Resources\IdeaResource\Pages;

use App\Filament\Resources\IdeaResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateIdea extends CreateRecord
{
    protected static string $resource = IdeaResource::class;
}
