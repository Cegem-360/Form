<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages;

use App\Filament\Admin\Resources\WebsiteTypePriceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListWebsiteTypePrices extends ListRecords
{
    protected static string $resource = WebsiteTypePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
