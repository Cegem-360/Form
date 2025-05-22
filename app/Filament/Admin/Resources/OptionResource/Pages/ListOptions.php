<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\OptionResource\Pages;

use App\Filament\Admin\Resources\OptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListOptions extends ListRecords
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
