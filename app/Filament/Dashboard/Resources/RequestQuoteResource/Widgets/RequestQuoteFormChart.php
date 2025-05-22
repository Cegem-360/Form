<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Widgets;

use App\Models\RequestQuote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

final class RequestQuoteFormChart extends BaseWidget
{
    protected function getStats(): array
    {
        /*  RequestQuote::query()
             ->webShop()->get()->count(); */

        return [
            Stat::make(__('Webshop request quotes'), RequestQuote::query()->whereUserId(Auth::user()->id)->webShop()->count()),
            Stat::make(__('Web site request quotes'), RequestQuote::query()->whereUserId(Auth::user()->id)->webSite()->count()),
            Stat::make(__('Landing page request quotes'), RequestQuote::query()->whereUserId(Auth::user()->id)->landingPage()->count()),
        ];
    }
}
