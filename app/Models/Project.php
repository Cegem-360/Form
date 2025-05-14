<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        // 1
        'user_id',
        'request_quote_id',
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

    public function formQuestions(): HasMany
    {
        return $this->hasMany(FormQuestion::class);
    }

    public function contactChannel(): BelongsTo
    {
        return $this->belongsTo(ContactChannel::class);
    }

    public function supportPack(): BelongsTo
    {
        return $this->belongsTo(SupportPack::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contact', 'id');
    }

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requestQuote(): BelongsTo
    {
        return $this->belongsTo(RequestQuote::class);
    }

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'contact' => 'integer',
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
