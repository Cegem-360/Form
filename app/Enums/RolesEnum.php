<?php

declare(strict_types=1);

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case EDITOR = 'editor';
    case MODERATOR = 'moderator';
    case CUSTOMER = 'customer';
    case GUEST = 'guest';
    case VENDOR = 'vendor';
    case RESELLER = 'reseller';
    case SUPER_ADMIN = 'super_admin';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrators',
            self::EDITOR => 'Editors',
            self::USER => 'Users',
            self::MODERATOR => 'Moderators',
            self::CUSTOMER => 'Customers',
            self::GUEST => 'Guests',
            self::VENDOR => 'Vendors',
            self::RESELLER => 'Resellers',
            self::SUPER_ADMIN => 'Super Administrators',

        };
    }
}
