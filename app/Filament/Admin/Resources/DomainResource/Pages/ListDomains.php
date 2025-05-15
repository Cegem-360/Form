<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\DomainResource\Pages;

use App\Filament\Resources\Admin\DomainResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListDomains extends ListRecords
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
