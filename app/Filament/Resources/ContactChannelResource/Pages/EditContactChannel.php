<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactChannelResource\Pages;

use App\Filament\Resources\ContactChannelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactChannel extends EditRecord
{
    protected static string $resource = ContactChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
