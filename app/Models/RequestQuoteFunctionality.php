<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RequestQuoteFunctionalityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuoteFunctionality extends Model
{
    /** @use HasFactory<RequestQuoteFunctionalityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'website_type_id',
    ];

    protected $casts = [
        'price' => 'integer',
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
