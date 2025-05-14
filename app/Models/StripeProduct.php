<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StripeProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class StripeProduct extends Model
{
    /** @use HasFactory<StripeProductFactory> */
    use HasFactory;
}
