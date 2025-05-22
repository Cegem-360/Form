<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages;

use App\Filament\Admin\Resources\WebsiteTypePriceResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWebsiteTypePrice extends CreateRecord
{
    protected static string $resource = WebsiteTypePriceResource::class;
}
