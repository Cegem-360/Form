<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Resources\RequestQuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRequestQuote extends ViewRecord
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
