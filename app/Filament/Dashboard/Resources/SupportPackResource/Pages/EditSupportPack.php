<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\SupportPackResource\Pages;

use App\Filament\Resources\Dashboard\SupportPackResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditSupportPack extends EditRecord
{
    protected static string $resource = SupportPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
