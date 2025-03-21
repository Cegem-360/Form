<?php

declare(strict_types=1);

namespace App\Enums;

enum OpenAIRole: string
{
    case SYSTEM = 'system';

    case USER = 'user';

}
