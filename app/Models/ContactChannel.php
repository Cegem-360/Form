<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ContactChannelFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static ContactChannelFactory factory($count = null, $state = [])
 * @method static Builder<static>|ContactChannel newModelQuery()
 * @method static Builder<static>|ContactChannel newQuery()
 * @method static Builder<static>|ContactChannel query()
 * @method static Builder<static>|ContactChannel whereCreatedAt($value)
 * @method static Builder<static>|ContactChannel whereId($value)
 * @method static Builder<static>|ContactChannel whereName($value)
 * @method static Builder<static>|ContactChannel whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ContactChannel extends Model
{
    /** @use HasFactory<ContactChannelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
