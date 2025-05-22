<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\PdfOptionResource\Pages;

use App\Filament\Admin\Resources\PdfOptionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreatePdfOption extends CreateRecord
{
    protected static string $resource = PdfOptionResource::class;
}
