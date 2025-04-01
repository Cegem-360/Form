<?php

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\WebsiteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebsiteType extends ViewRecord
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
