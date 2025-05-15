<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\Admin\WebsiteTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListWebsiteTypes extends ListRecords
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
