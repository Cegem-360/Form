<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string|null $company_name
 * @property int $website_type_id
 * @property array<array-key, mixed>|null $websites
 * @property int $have_website_graphic
 * @property array<array-key, mixed>|null $functionalities
 * @property int $is_multilangual
 * @property array<array-key, mixed>|null $languages
 * @property int $is_ecommerce
 * @property array<array-key, mixed>|null $ecommerce_functionalities
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WebsiteType|null $websiteType
 * @method static \Database\Factories\RequestQuoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereEcommerceFunctionalities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereFunctionalities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereHaveWebsiteGraphic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereIsEcommerce($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereIsMultilangual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereWebsiteTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereWebsites($value)
 * @mixin \Eloquent
 */
class RequestQuote extends Model
{
    /** @use HasFactory<\Database\Factories\RequestQuoteFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'website_type_id',
        'websites',
        'have_website_graphic',
        'functionalities',
        'is_multilangual',
        'languages',
        'is_ecommerce',
        'ecommerce_functionalities',
    ];

    protected $casts = [
        'websites' => 'array',
        'functionalities' => 'array',
        'languages' => 'array',
        'ecommerce_functionalities' => 'array',
    ];

    public function websiteType()
    {
        return $this->belongsTo(WebsiteType::class);
    }
}
