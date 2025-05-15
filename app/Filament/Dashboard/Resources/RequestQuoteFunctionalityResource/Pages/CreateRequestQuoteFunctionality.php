<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Resources\Dashboard\RequestQuoteFunctionalityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRequestQuoteFunctionality extends CreateRecord
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;
}
