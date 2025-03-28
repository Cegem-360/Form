<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property ProjectStatus $status
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $created_by
 * @property int $updated_by
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
