<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\RequestQuoteResource\Pages;

use App\Filament\Dashboard\Resources\RequestQuoteResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRequestQuote extends CreateRecord
{
    protected static string $resource = RequestQuoteResource::class;
}
