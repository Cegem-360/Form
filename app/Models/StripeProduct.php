<?php

namespace App\Models;

use Database\Factories\StripeProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeProduct extends Model
{
    /** @use HasFactory<StripeProductFactory> */
    use HasFactory;
}
