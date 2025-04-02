<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\WebsiteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteType extends EditRecord
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
