<?php

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
            static::ADMIN => 'Administrators',
            static::EDITOR => 'Editors',
            static::USER => 'Users',
            static::MODERATOR => 'Moderators',
            static::CUSTOMER => 'Customers',
            static::GUEST => 'Guests',
            static::VENDOR => 'Vendors',
            static::RESELLER => 'Resellers',
            static::SUPER_ADMIN => 'Super Administrators',

        };
    }
}
