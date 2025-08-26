<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SupportPackFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class SupportPack extends Model
{
    /** @use HasFactory<SupportPackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
