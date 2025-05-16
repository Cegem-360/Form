<?php

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPdfOptions extends ListRecords
{
    protected static string $resource = PdfOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
