<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientType;
use Database\Factories\RequestQuoteFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class RequestQuote extends Model
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
        'payment_method',
        'project_description',
        'billing_address',
    ];

    public function websiteType(): BelongsTo
    {
        return $this->belongsTo(WebsiteType::class);
    }

    public function requestQuoteFunctionalities(): BelongsToMany
    {
        return $this->belongsToMany(RequestQuoteFunctionality::class);
    }

    public function requestQuoteFunctionalitiesNotDefault(): BelongsToMany
    {
        return $this->requestQuoteFunctionalities()->notDefault();
    }

    public function requestQuoteFunctionalitiesDefault(): BelongsToMany
    {
        return $this->requestQuoteFunctionalities()->default();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requestLanguages(): HasMany
    {
        return $this->hasMany(WebsiteLanguage::class);
    }

    public function pdfOptions(): HasMany
    {
        return $this->hasMany(PdfOption::class);
    }

    public function getTotalPriceAttribute(): int
    {
        $total = 0;

        foreach ($this->websites as $website) {
            if ($website['required']) {
                $total += $this->websiteType->websiteTypePrices()
                    ->whereWebsiteEngine($this->website_engine)
                    ->whereSize($website['length'])
                    ->first()
                    ?->price ?? 0;
            }
        }
        if ($this->is_multilangual && is_array($this->languages) && count($this->languages) > 0) {
            $additionalLanguages = count($this->languages);
            $total += (int) round($total * (0.2 * $additionalLanguages));
        }

        return $total + $this->requestQuoteFunctionalities->sum('price');
    }

    #[Scope]
    public function webShop(Builder $query): Builder
    {
        return $query->whereHas('websiteType', function ($q) {
            return $q->whereName('Webshop');
        });
    }

    #[Scope]
    public function webSite(Builder $query): Builder
    {
        return $query->whereHas('websiteType', function ($q) {
            return $q->whereName('Weboldal');
        });
    }

    #[Scope]
    public function landingPage(Builder $query): Builder
    {
        return $query->whereHas('websiteType', function ($q) {
            return $q->whereName('Landing Page');
        });
    }

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
}
