<?php

declare(strict_types=1);

namespace App\Filament\Resources\SystemChatParameterResource\Pages;

use App\Filament\Resources\SystemChatParameterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSystemChatParameters extends ListRecords
{
    protected static string $resource = SystemChatParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
