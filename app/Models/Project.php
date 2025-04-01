<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property ProjectStatus $status
 * @property string|null $project_goal
 * @property array<array-key, mixed>|null $original_project_goals
 * @property array<array-key, mixed>|null $completed_project_elements
 * @property array<array-key, mixed>|null $project_not_contained_elements
 * @property array<array-key, mixed>|null $completed_elements
 * @property array<array-key, mixed>|null $solved_problems
 * @property int|null $garanty
 * @property string|null $garanty_end_date
 * @property \App\Models\User|null $contact
 * @property int|null $support_pack_id
 * @property int|null $contact_channel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ContactChannel|null $contactChannel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormQuestion> $formQuestions
 * @property-read int|null $form_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Idea> $ideas
 * @property-read int|null $ideas_count
 * @property-read \App\Models\SupportPack|null $supportPack
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedProjectElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContactChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGaranty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGarantyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereOriginalProjectGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectNotContainedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSolvedProblems($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSupportPackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        // 1
        'name',
        'contact',
        'start_date',
        'end_date',

        'status',
        'project_goal',

        // 2.
        'original_project_goals',
        'completed_project_elements',
        'project_not_contained_elements',

        // 3.
        'completed_elements',
        'solved_problems',

        // 4.
        'garanty',
        'support_pack_id',
        'contact_channel_id',

        'created_by', // user_id
        'updated_by', // user_id
    ];

    public function formQuestions()
    {
        return $this->hasMany(FormQuestion::class);
    }

    public function contactChannel()
    {
        return $this->belongsTo(ContactChannel::class);
    }

    public function supportPack()
    {
        return $this->belongsTo(SupportPack::class);
    }

    public function contact()
    {
        return $this->belongsTo(User::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'contact' => 'json',
            'original_project_goals' => 'json',
            'completed_project_elements' => 'json',
            'project_not_contained_elements' => 'json',
            'completed_elements' => 'json',
            'tests' => 'json',
            'solved_problems' => 'json',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
