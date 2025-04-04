<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteType extends Model
{
    /** @use HasFactory<\Database\Factories\WebsiteTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function requestQuotes(): HasMany
    {
        return $this->hasMany(RequestQuote::class);
    }

    public function requestQuoteFunctionalities(): HasMany
    {
        return $this->hasMany(RequestQuoteFunctionality::class);
    }
}
