<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientType;
use Database\Factories\RequestQuoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RequestQuote extends Model
{
    /** @use HasFactory<RequestQuoteFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quotation_name',
        'name',
        'email',
        'phone',
        'client_type',
        'company_name',
        'company_address',
        'website_type_id',
        'websites',
        'have_website_graphic',
        'is_multilangual',
        'languages',
        'website_engine',
    ];

    protected function casts(): array
    {
        return [
            'websites' => 'array',
            'functionalities' => 'array',
            'languages' => 'array',
            'is_multilangual' => 'boolean',
            'have_website_graphic' => 'boolean',
            'client_type' => ClientType::class,
        ];
    }

    public function websiteType()
    {
        return $this->belongsTo(WebsiteType::class);
    }

    public function requestQuoteFunctionalities(): BelongsToMany
    {
        return $this->belongsToMany(RequestQuoteFunctionality::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
