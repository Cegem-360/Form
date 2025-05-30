<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FormQuestionStatus: string implements HasLabel
{
    case UNFILLED = 'unfilled';
    case TEMPORARILY_SAVED = 'temporarily_saved';
    case SUBMITTED = 'submitted';

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
            self::UNFILLED => __('unfilled'),
            self::TEMPORARILY_SAVED => __('temporarily saved'),
            self::SUBMITTED => __('submitted'),
        };
    }
}
