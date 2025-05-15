<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SupportPackResource\Pages;

use App\Filament\Resources\Admin\SupportPackResource;
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
