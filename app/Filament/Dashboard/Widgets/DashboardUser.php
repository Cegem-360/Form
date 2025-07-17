<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;

final class DashboardUser extends BaseWidget
{
    protected string $view = 'filament.widgets.dashboard-user';

    // Widget sorrendjének beállítása (kisebb szám = előrébb jelenik meg)
    protected static ?int $sort = 1;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getStats(): array
    {
        return [];
    }
}
