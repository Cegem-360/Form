<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditPdfOption extends EditRecord
{
    protected static string $resource = PdfOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
