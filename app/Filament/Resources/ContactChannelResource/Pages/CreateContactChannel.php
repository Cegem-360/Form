<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactChannelResource\Pages;

use App\Filament\Resources\ContactChannelResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateContactChannel extends CreateRecord
{
    protected static string $resource = ContactChannelResource::class;
}
