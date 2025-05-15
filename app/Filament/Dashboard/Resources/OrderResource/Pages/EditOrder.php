<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderResource\Pages;

use App\Filament\Resources\Dashboard\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
