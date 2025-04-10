<?php

declare(strict_types=1);

namespace App\Enums;

enum StripeCurrency: string
{
    case USD = 'usd';
    case EUR = 'eur';
    case GBP = 'gbp';
    case JPY = 'jpy';
    case AUD = 'aud';
    case CAD = 'cad';
    case CHF = 'chf';
    case CNY = 'cny';
    case SEK = 'sek';
    case NZD = 'nzd';
    case HUF = 'huf';

}
