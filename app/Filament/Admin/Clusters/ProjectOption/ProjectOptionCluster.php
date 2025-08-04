<?php

declare(strict_types=1);

namespace App\Filament\Admin\Clusters\ProjectOption;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

final class ProjectOptionCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'Project';

    protected static ?int $navigationSort = 100;
}
