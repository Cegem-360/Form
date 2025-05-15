<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages;

use App\Filament\Resources\Admin\RequestQuoteFunctionalityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRequestQuoteFunctionality extends CreateRecord
{
    protected static string $resource = RequestQuoteFunctionalityResource::class;
}
