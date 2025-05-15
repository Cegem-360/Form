<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\SupportPackResource\Pages;

use App\Filament\Resources\Admin\SupportPackResource;
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
