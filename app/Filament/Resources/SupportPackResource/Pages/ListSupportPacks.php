<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupportPackResource\Pages;

use App\Filament\Resources\SupportPackResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportPacks extends ListRecords
{
    protected static string $resource = SupportPackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
