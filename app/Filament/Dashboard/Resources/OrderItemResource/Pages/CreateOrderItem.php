<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderItemResource\Pages;

use App\Filament\Resources\Dashboard\OrderItemResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateOrderItem extends CreateRecord
{
    protected static string $resource = OrderItemResource::class;
}
