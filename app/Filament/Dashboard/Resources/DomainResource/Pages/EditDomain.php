<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\DomainResource\Pages;

use App\Filament\Dashboard\Resources\DomainResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditDomain extends EditRecord
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
