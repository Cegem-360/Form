<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;
use Database\Factories\SupportPackFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static SupportPackFactory factory($count = null, $state = [])
 * @method static Builder<static>|SupportPack newModelQuery()
 * @method static Builder<static>|SupportPack newQuery()
 * @method static Builder<static>|SupportPack query()
 * @method static Builder<static>|SupportPack whereCreatedAt($value)
 * @method static Builder<static>|SupportPack whereId($value)
 * @method static Builder<static>|SupportPack whereName($value)
 * @method static Builder<static>|SupportPack whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SupportPack extends Model
{
    /** @use HasFactory<SupportPackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
