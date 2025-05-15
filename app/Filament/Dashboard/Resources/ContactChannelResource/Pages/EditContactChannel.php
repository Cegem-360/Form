<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ContactChannelResource\Pages;

use App\Filament\Resources\Dashboard\ContactChannelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditContactChannel extends EditRecord
{
    protected static string $resource = ContactChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
