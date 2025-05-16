<?php

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePdfOption extends CreateRecord
{
    protected static string $resource = PdfOptionResource::class;
}
