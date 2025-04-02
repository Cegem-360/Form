<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLanguage extends Model
{
    /** @use HasFactory<\Database\Factories\WebsiteLanguageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];
}
