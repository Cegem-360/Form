<?php

declare(strict_types=1);

namespace App\Filament\Resources\SystemChatParameterResource\Pages;

use App\Filament\Resources\SystemChatParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSystemChatParameter extends EditRecord
{
    protected static string $resource = SystemChatParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
