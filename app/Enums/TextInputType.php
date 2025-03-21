<?php

declare(strict_types=1);

namespace App\Enums;

enum TextInputType: string
{
    case COLOR = 'color';

    case NUMERIC = 'numeric';

    case INTEGER = 'integer';

    case EMAIL = 'email';

    case URL = 'url';

    case PASSWORD = 'password';

    case TEL = 'tel';

}
