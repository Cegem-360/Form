<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\IdeaResource\Pages;

use App\Filament\Resources\Admin\IdeaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewIdea extends ViewRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
