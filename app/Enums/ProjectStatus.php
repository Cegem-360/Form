<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasLabel
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function getKeys(): array
    {
        return array_column(self::cases(), 'name');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => __('ACTIVE'),
            self::INACTIVE => __('INACTIVE'),
            self::PENDING => __('PENDING'),
            self::COMPLETED => __('COMPLETED'),
            self::CANCELLED => __('CANCELLED'),
        };
    }
}
