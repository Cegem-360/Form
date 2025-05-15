<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ContactChannelResource\Pages;

use App\Filament\Admin\Resources\ContactChannelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewContactChannel extends ViewRecord
{
    protected static string $resource = ContactChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
