<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupportPackResource\Pages;

use App\Filament\Resources\SupportPackResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSupportPack extends CreateRecord
{
    protected static string $resource = SupportPackResource::class;
}
