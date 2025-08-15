<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ContactChannelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ContactChannel extends Model
{
    /** @use HasFactory<ContactChannelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
