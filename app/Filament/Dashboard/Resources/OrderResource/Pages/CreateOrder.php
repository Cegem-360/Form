<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderResource\Pages;

use App\Filament\Resources\Dashboard\OrderResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
