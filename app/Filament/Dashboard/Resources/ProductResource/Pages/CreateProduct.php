<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProductResource\Pages;

use App\Filament\Resources\Dashboard\ProductResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
