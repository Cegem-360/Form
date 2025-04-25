<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\WebsiteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteTypes extends ListRecords
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
