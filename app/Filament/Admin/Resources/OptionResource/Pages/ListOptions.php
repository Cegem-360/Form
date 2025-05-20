<?php

namespace App\Filament\Admin\Resources\OptionResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptions extends ListRecords
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
