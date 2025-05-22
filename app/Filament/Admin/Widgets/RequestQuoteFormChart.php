<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use App\Models\RequestQuote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class RequestQuoteFormChart extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make(__('Webshop request quotes'), RequestQuote::query()->webShop()->count()),
            Stat::make(__('Web site request quotes'), RequestQuote::query()->webSite()->count()),
            Stat::make(__('Landing page request quotes'), RequestQuote::query()->landingPage()->count()),
        ];
    }
}
