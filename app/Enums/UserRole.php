<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case GUEST = 'guest';
    case USER = 'user';
    case PROJECT_MANAGER = 'project-manager';
    case PROJECT_EDITOR = 'project-editor';
    case PROJECT_VIEWER = 'project-viewer';
    case REQUEST_QUOTE_USER = 'request-quote-user';
    case REQUEST_QUOTE_ADMIN = 'request-quote-admin';
    case PARTNER = 'partner';
    case B2B_USER = 'b2b-user';

}
