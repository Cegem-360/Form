<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\UserResource\Pages;

use App\Filament\Resources\Dashboard\UserResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
