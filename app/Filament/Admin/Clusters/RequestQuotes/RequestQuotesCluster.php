<?php

declare(strict_types=1);

namespace App\Filament\Admin\Clusters\RequestQuotes;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

final class RequestQuotesCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'Request Quote';
}
