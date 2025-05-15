<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\IdeaResource\Pages;

use App\Filament\Resources\Admin\IdeaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListIdeas extends ListRecords
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
