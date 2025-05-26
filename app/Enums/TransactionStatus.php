<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TransactionStatus: string implements HasLabel
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::COMPLETED => __('completed'),
            self::FAILED => __('failed'),
            self::REFUNDED => __('refunded'),
        };
    }
}
