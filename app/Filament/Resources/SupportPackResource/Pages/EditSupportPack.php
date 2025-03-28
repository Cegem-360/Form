<?php

namespace App\Filament\Resources\SupportPackResource\Pages;

use App\Filament\Resources\SupportPackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportPack extends EditRecord
{
    protected static string $resource = SupportPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
