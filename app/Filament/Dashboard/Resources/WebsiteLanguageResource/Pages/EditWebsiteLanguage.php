<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Resources\Dashboard\WebsiteLanguageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditWebsiteLanguage extends EditRecord
{
    protected static string $resource = WebsiteLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
