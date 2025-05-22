<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\OptionResource\Pages;

use App\Filament\Admin\Resources\OptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
