<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\SystemChatParameterResource\Pages;

use App\Filament\Resources\Dashboard\SystemChatParameterResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSystemChatParameter extends CreateRecord
{
    protected static string $resource = SystemChatParameterResource::class;
}
