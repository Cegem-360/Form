<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\DomainResource\Pages;

use App\Filament\Resources\Dashboard\DomainResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateDomain extends CreateRecord
{
    protected static string $resource = DomainResource::class;
}
