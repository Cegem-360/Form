<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProductResource\Pages;

use App\Filament\Dashboard\Resources\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
