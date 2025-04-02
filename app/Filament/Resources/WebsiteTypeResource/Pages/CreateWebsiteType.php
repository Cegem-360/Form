<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\WebsiteTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWebsiteType extends CreateRecord
{
    protected static string $resource = WebsiteTypeResource::class;
}
