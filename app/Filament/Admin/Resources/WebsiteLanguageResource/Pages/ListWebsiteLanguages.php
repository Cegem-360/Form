<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Admin\Resources\WebsiteLanguageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListWebsiteLanguages extends ListRecords
{
    protected static string $resource = WebsiteLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
