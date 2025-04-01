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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuote> $requestQuotes
 * @property-read int|null $request_quotes_count
 * @method static \Database\Factories\WebsiteTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WebsiteType extends Model
{
    /** @use HasFactory<\Database\Factories\WebsiteTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function requestQuotes()
    {
        return $this->hasMany(RequestQuote::class);
    }
}
