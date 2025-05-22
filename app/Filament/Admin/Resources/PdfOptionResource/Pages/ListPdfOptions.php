<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListPdfOptions extends ListRecords
{
    protected static string $resource = PdfOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
