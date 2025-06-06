<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProjectCommissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ProjectCommission extends Model
{
    /** @use HasFactory<ProjectCommissionFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'commission_amount',
        'commission_percent',
        'commission_paid_amount',
    ];

    protected $casts = [
        'commission_amount' => 'integer',
        'commission_percent' => 'float',
        'commission_paid_amount' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
