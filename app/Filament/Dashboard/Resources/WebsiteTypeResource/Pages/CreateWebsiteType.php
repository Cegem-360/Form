<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\Dashboard\WebsiteTypeResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWebsiteType extends CreateRecord
{
    protected static string $resource = WebsiteTypeResource::class;
}
