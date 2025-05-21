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

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::EDITOR => 'Editors',
            static::USER => 'Users',
            static::MODERATOR => 'Moderators',
            static::CUSTOMER => 'Customers',
            static::GUEST => 'Guests',
            static::VENDOR => 'Vendors',
        };
    }
}
