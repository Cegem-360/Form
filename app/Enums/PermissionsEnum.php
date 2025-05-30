<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PermissionsEnum: string implements HasLabel
{
    case VIEW = 'view';
    case VIEW_ANY = 'view-any';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case DELETE_ANY = 'delete-any';
    case REPLICATE = 'replicate';
    case RESTORE = 'restore';
    case RESTORE_ANY = 'restore-any';
    case REORDER = 'reorder';
    case FORCE_DELETE = 'force-delete';
    case FORCE_DELETE_ANY = 'force-delete-any';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function getLabel(): string
    {
        return match ($this) {
            self::VIEW => 'View',
            self::VIEW_ANY => 'View Any',
            self::CREATE => 'Create',
            self::UPDATE => 'Update',
            self::DELETE => 'Delete',
            self::DELETE_ANY => 'Delete Any',
            self::REPLICATE => 'Replicate',
            self::RESTORE => 'Restore',
            self::RESTORE_ANY => 'Restore Any',
            self::REORDER => 'Reorder',
            self::FORCE_DELETE => 'Force Delete',
            self::FORCE_DELETE_ANY => 'Force Delete Any',
        };
    }
}
