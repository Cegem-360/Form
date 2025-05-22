<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;

final class DashboardUser extends BaseWidget
{
    protected static string $view = 'filament.widgets.dashboard-user';

    // Widget sorrendjének beállítása (kisebb szám = előrébb jelenik meg)
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [];
    }
}
