<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactChannelResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\ContactChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactChannels extends ListRecords
{
    protected static string $resource = ContactChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
