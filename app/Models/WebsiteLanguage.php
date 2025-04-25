<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\WebsiteLanguageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLanguage extends Model
{
    /** @use HasFactory<WebsiteLanguageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];
}
