<?php

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPdfOption extends EditRecord
{
    protected static string $resource = PdfOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
