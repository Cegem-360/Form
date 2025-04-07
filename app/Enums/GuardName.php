<?php

declare(strict_types=1);

namespace App\Enums;

enum GuardName: string
{
    case WEB = 'web';
    case API = 'api';
    case SANCTUM = 'sanctum';
    case FILAMENT = 'filament';
    case FILAMENT_API = 'filament-api';
}
