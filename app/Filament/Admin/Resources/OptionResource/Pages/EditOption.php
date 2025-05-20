<?php

namespace App\Filament\Admin\Resources\OptionResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
