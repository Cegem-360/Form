<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PdfOption extends Model
{
    /** @use HasFactory<\Database\Factories\PdfOptionsFactory> */
    use HasFactory;

    protected $fillable = [
        'website_type_id',
        'website_engine',
        'frontend_description',
        'backend_description',
        'delivery_deadline',
    ];

    public function websiteType(): BelongsTo
    {
        return $this->belongsTo(WebsiteType::class);
    }

    public function deliveryDeadLine(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value === null ? 'Vállalási határidő

A weboldal a szükséges anyagok (szövegek, képek, logók, egyéb információk) átadását követő

30 munkanapon belül elkészül.' : $value,
        );
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
}
