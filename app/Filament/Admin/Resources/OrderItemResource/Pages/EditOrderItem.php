<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\OrderItemResource\Pages;

use App\Filament\Resources\Admin\OrderItemResource;
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
