<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuote extends Model
{
    /** @use HasFactory<\Database\Factories\RequestQuoteFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'client_type',
        'company_name',
        'website_type_id',
        'websites',
        'have_website_graphic',
        'is_multilangual',
        'languages',
        'is_ecommerce',
        'ecommerce_functionalities',
        'website_engine',
    ];

    protected $casts = [
        'websites' => 'array',
        'functionalities' => 'array',
        'languages' => 'array',
        'ecommerce_functionalities' => 'array',
        'is_multilangual' => 'boolean',
        'is_ecommerce' => 'boolean',
        'have_website_graphic' => 'boolean',
        'client_type' => ClientType::class,
    ];

    public function websiteType()
    {
        return $this->belongsTo(WebsiteType::class);
    }

    public function requestQuoteFunctionalities()
    {
        return $this->belongsToMany(RequestQuoteFunctionality::class);
    }
}
