<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static IdeaFactory factory($count = null, $state = [])
 * @method static Builder<static>|Idea newModelQuery()
 * @method static Builder<static>|Idea newQuery()
 * @method static Builder<static>|Idea query()
 * @method static Builder<static>|Idea whereCreatedAt($value)
 * @method static Builder<static>|Idea whereDescription($value)
 * @method static Builder<static>|Idea whereId($value)
 * @method static Builder<static>|Idea whereName($value)
 * @method static Builder<static>|Idea whereProjectId($value)
 * @method static Builder<static>|Idea whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;
}
