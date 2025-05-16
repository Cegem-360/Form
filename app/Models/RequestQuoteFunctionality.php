<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RequestQuoteFunctionalityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class RequestQuoteFunctionality extends Model
{
    /** @use HasFactory<RequestQuoteFunctionalityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'website_type_id',
        'default',
    ];

    protected $casts = [
        'price' => 'integer',
        'default' => 'boolean',
    ];

    public function requestQuotes()
    {
        return $this->belongsToMany(RequestQuote::class);
    }

    public function websiteType()
    {
        return $this->belongsTo(WebsiteType::class);
    }
}
