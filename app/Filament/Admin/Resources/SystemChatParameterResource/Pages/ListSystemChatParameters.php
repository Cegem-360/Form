<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SystemChatParameterResource\Pages;

use App\Filament\Resources\Admin\SystemChatParameterResource;
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
