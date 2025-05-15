<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\Admin\WebsiteTypeResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWebsiteType extends CreateRecord
{
    protected static string $resource = WebsiteTypeResource::class;
}
