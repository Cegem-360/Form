<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientType;
use App\Observers\RequestQuoteObserver;
use Database\Factories\RequestQuoteFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(RequestQuoteObserver::class)]
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
        'default_language',
        'languages',
        'website_engine',
        'payment_method',
        'project_description',
        'billing_address',
        'is_payed',
    ];

    public function requestQuotePercent(): ?float
    {
        return $this->requestQuotePercent = collect(Option::whereName('request_quote')
            ->first()->options)->keyBy('key')['language_percent']['value'];
    }

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
        $total = $this->getTotalPriceAttributeNoLanguages();

        if ($this->is_multilangual && is_array($this->languages) && $this->languages !== []) {

            $tmp = $total;
            foreach ($this->languages as $language) {
                $total += (int) round($tmp * $this->requestQuotePercent());
            }
        }

        return $total;
    }

    public function getTotalPriceAttributeNoLanguages(): int
    {
        $total = 0;

        foreach ($this->websites ?? [] as $website) {
            if (isset($website['required']) && $website['required']) {
                $total += $this->websiteType->websiteTypePrices()
                    ->whereWebsiteEngine($this->website_engine)
                    ->whereSize($website['length'])
                    ->first()
                    ?->price ?? 0;
            }
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

    public function getLanguages(): Collection
    {
        return WebsiteLanguage::whereIn('id', $this->languages)->get();
    }

    public function isPayed(): bool
    {
        // Feltételezve, hogy van egy kapcsolódó rendelés (order) reláció
        // és annak van egy 'status' mezője, ami 'paid' értéket vehet fel
        if ($this->order && $this->order->status === 'paid') {
            return true;
        }

        return (bool) $this->is_payed;
    }

    public function canOrderAgain(): bool
    {
        // Ha már ki van fizetve, nem lehet újra megrendelni
        return ! $this->isPayed();
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
            'is_payed' => 'boolean',
        ];
    }
}
