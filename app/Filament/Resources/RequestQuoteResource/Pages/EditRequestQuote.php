<?php

namespace App\Filament\Resources\RequestQuoteResource\Pages;

use App\Filament\Resources\RequestQuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestQuote extends EditRecord
{
    protected static string $resource = RequestQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
