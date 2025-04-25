<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupportPackResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\SupportPackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportPack extends EditRecord
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
