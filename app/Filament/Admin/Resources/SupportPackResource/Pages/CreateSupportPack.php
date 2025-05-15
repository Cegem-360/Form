<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SupportPackResource\Pages;

use App\Filament\Resources\Admin\SupportPackResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSupportPack extends CreateRecord
{
    protected static string $resource = SupportPackResource::class;
}
