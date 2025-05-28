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
    case ADVANCE_PENDING = 'advance_pending';
    case ADVANCE_COMPLETED = 'advance_completed';
    case FINAL_INVOICE_PENDING = 'final_invoice_pending';
    case FINAL_INVOICE_COMPLETED = 'final_invoice_completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
            self::ADVANCE_PENDING => 'Advance Pending',
            self::ADVANCE_COMPLETED => 'Advance Completed',
            self::FINAL_INVOICE_PENDING => 'Final Invoice Pending',
            self::FINAL_INVOICE_COMPLETED => 'Final Invoice Completed',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::COMPLETED => __('completed'),
            self::FAILED => __('failed'),
            self::REFUNDED => __('refunded'),
            self::ADVANCE_PENDING => __('advance_pending'),
            self::ADVANCE_COMPLETED => __('advance_completed'),
            self::FINAL_INVOICE_PENDING => __('final_invoice_pending'),
            self::FINAL_INVOICE_COMPLETED => __('final_invoice_completed'),
        };
    }
}
