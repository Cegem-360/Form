<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\RequestQuoteFunctionalityFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class RequestQuoteFunctionality extends Model
{
    /** @use HasFactory<RequestQuoteFunctionalityFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'website_type_id',
        'website_engine',
        'default',
    ];

    protected $casts = [
        'price' => 'integer',
        'default' => 'boolean',
    ];

    #[Scope]
    public function webShop(Builder $query): Builder
    {
        return $query->whereWebsiteEngine('Webáruház');
    }

    #[Scope]
    public function webSite(Builder $query): Builder
    {
        return $query->whereWebsiteEngine('Weboldal');
    }

    #[Scope]
    public function landingPage(Builder $query): Builder
    {
        return $query->whereWebsiteEngine('Landing Page');
    }

    #[Scope]
    public function notDefault(Builder $query): Builder
    {
        return $query->whereDefault(false);
    }

    #[Scope]
    public function default(Builder $query): Builder
    {
        return $query->whereDefault(true);
    }

    public function requestQuotes(): BelongsToMany
    {
        return $this->belongsToMany(RequestQuote::class);
    }

    public function websiteType(): BelongsTo
    {
        return $this->belongsTo(WebsiteType::class);
    }
}
