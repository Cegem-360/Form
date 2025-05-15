<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Admin\Resources\WebsiteLanguageResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateWebsiteLanguage extends CreateRecord
{
    protected static string $resource = WebsiteLanguageResource::class;
}
