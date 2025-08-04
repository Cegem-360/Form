<?php

declare(strict_types=1);

namespace App\Enums;

enum NavigationGroup: string
{
    case DASHBOARD = 'dashboard';
    case USERS = 'users';
    case SETTINGS = 'settings';
    case REPORTS = 'reports';
    case ANALYTICS = 'analytics';
    case SUPPORT = 'support';
}
