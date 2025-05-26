<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\OrderResource\Pages;

use App\Filament\Dashboard\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
