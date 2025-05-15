<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SystemChatParameterResource\Pages;

use App\Filament\Resources\Admin\SystemChatParameterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditSystemChatParameter extends EditRecord
{
    protected static string $resource = SystemChatParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
