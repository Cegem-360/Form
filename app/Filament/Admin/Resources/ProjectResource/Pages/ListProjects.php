<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Filament\Resources\Admin\ProjectResource;
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
