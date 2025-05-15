<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ProjectResource\Pages;

use App\Filament\Resources\Dashboard\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
