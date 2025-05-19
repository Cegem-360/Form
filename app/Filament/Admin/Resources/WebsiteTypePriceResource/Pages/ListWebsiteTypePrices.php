<?php

namespace App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\WebsiteTypePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteTypePrices extends ListRecords
{
    protected static string $resource = WebsiteTypePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
