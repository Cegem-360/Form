<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderItemResource\Pages;

use App\Filament\Resources\Dashboard\OrderItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListOrderItems extends ListRecords
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
