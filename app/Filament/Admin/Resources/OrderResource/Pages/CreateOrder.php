<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Resources\Admin\OrderResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
