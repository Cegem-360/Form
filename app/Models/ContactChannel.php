<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ContactChannelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ContactChannel extends Model
{
    /** @use HasFactory<\Database\Factories\ContactChannelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
