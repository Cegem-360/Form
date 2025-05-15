<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewRequestQuote extends ViewRecord
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
