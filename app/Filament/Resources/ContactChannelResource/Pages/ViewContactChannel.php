<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactChannelResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Resources\ContactChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactChannel extends ViewRecord
{
    protected static string $resource = ContactChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
