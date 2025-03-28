<?php

declare(strict_types=1);

namespace App\Enums;

enum ProjectStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function getValues(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::COMPLETED,
            self::CANCELLED,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::ACTIVE->value => 'Active',
            self::INACTIVE->value => 'Inactive',
            self::PENDING->value => 'Pending',
            self::COMPLETED->value => 'Completed',
            self::CANCELLED->value => 'Cancelled',
        ];
    }

    public static function getLabel(string $value): string
    {
        return self::getLabels()[$value] ?? '';
    }

    public static function getLabelFromValue(string $value): string
    {
        return self::getLabel($value);
    }

    public static function getLabelFromKey(string $key): string
    {
        return self::getLabel($key);
    }

    public static function getKeys(): array
    {
        return array_keys(self::getLabels());
    }

    public static function getKeysFromValues(array $values): array
    {
        return array_intersect(self::getValues(), $values);
    }

    public static function getValuesFromKeys(array $keys): array
    {
        return array_intersect(self::getKeys(), $keys);
    }

    public static function getValuesFromLabels(array $labels): array
    {
        return array_intersect(self::getLabels(), $labels);
    }
}
