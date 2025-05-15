<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProductResource\Pages;

use App\Filament\Resources\Dashboard\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
