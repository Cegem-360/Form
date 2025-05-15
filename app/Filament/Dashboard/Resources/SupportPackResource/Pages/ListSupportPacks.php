<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\SupportPackResource\Pages;

use App\Filament\Resources\Dashboard\SupportPackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSupportPacks extends ListRecords
{
    protected static string $resource = SupportPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
