<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Pages;

use App\Filament\Resources\Admin\RequestQuoteResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRequestQuote extends CreateRecord
{
    protected static string $resource = RequestQuoteResource::class;
}
