<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Filament\Resources\Admin\ProjectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
