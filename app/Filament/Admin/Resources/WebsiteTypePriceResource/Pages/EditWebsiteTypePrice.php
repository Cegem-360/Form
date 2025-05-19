<?php

namespace App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\WebsiteTypePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteTypePrice extends EditRecord
{
    protected static string $resource = WebsiteTypePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
