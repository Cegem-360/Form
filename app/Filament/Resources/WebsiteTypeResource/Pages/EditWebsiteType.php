<?php

declare(strict_types=1);

namespace App\Filament\Resources\WebsiteTypeResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\WebsiteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteType extends EditRecord
{
    protected static string $resource = WebsiteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
