<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages;

use App\Filament\Admin\Resources\WebsiteTypePriceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditWebsiteTypePrice extends EditRecord
{
    protected static string $resource = WebsiteTypePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
