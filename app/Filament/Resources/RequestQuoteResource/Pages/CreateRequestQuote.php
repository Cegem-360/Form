<?php

declare(strict_types=1);

namespace App\Filament\Resources\RequestQuoteResource\Pages;

use App\Filament\Resources\RequestQuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRequestQuote extends CreateRecord
{
    protected static string $resource = RequestQuoteResource::class;
}
