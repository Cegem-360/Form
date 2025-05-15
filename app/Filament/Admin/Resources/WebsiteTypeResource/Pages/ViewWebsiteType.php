<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypeResource\Pages;

use App\Filament\Admin\Resources\WebsiteTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewWebsiteType extends ViewRecord
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
