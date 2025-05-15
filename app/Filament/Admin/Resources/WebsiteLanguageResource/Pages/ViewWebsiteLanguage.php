<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Admin\Resources\WebsiteLanguageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewWebsiteLanguage extends ViewRecord
{
    protected static string $resource = WebsiteLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
