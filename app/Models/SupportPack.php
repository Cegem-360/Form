<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPack extends Model
{
    /** @use HasFactory<\Database\Factories\SupportPackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
