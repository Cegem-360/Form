<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\ContactChannelResource\Pages;

use App\Filament\Resources\Dashboard\ContactChannelResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateContactChannel extends CreateRecord
{
    protected static string $resource = ContactChannelResource::class;
}
