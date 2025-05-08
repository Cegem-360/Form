<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ClientType: string implements HasLabel
{
    case COMPANY = 'company';
    case INDIVIDUAL = 'individual';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::COMPANY => __('COMPANY'),
            self::INDIVIDUAL => __('INDIVIDUAL'),

        };
    }
}
