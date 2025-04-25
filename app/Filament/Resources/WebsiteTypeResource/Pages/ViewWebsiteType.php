<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Resources\WebsiteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebsiteType extends ViewRecord
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
