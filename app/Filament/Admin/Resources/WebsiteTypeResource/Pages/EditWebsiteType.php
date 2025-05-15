<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypeResource\Pages;

use App\Filament\Resources\Admin\WebsiteTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditWebsiteType extends EditRecord
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
