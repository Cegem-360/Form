<?php

declare(strict_types=1);

namespace App\Enums\Order;

use Filament\Support\Contracts\HasLabel;

enum OrderStatusesEnum: string implements HasLabel
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function casesArray(): array
    {
        return array_map(
            fn (self $case) => $case->value,
            self::cases()
        );
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE => __('active'),
            self::INACTIVE => __('inactive'),
            self::PENDING => __('pending'),
            self::COMPLETED => __('completed'),
            self::CANCELLED => __('cancelled'),
        };
    }
}
