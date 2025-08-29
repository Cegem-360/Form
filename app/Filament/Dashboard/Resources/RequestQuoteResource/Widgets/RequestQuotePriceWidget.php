<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

final class RequestQuotePriceWidget extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $totalPrice = $this->record?->totalPrice ?? 0;
        $totalPriceHtml = Number::currency($totalPrice, 'HUF', 'hu_HU', 0);
        $discount = Number::currency($totalPrice / 2, 'HUF', 'hu_HU', 0);

        return [
            Stat::make('Total Price', $totalPriceHtml)
                ->label(__('Quote Amount'))
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('Discount', $discount)
                ->label(__('Deposit Price'))
                ->color('warning')
                ->icon('heroicon-o-tag'),
        ];
    }
}
