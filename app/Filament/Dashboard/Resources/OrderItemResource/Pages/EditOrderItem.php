<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderItemResource\Pages;

use App\Filament\Resources\Dashboard\OrderItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditOrderItem extends EditRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
