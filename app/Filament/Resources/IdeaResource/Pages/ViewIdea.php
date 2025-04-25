<?php

declare(strict_types=1);

namespace App\Filament\Resources\IdeaResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\Resources\IdeaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIdea extends ViewRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
