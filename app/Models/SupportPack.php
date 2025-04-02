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
 * @method static \Database\Factories\SupportPackFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SupportPack extends Model
{
    /** @use HasFactory<\Database\Factories\SupportPackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
