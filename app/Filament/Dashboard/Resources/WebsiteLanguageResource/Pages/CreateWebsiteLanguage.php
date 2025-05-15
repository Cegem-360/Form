<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Dashboard\Resources\WebsiteLanguageResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWebsiteLanguage extends CreateRecord
{
    protected static string $resource = WebsiteLanguageResource::class;
}
