<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Filament\Resources\Admin\ProductResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
