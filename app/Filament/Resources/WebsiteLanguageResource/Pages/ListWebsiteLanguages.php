<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteLanguageResource\Pages;

use App\Filament\Resources\WebsiteLanguageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteLanguages extends ListRecords
{
    protected static string $resource = WebsiteLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
