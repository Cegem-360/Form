<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Project;
use App\Models\ProjectCommission;
use App\Models\User;

final class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $requestQuote = $project->requestQuote;
        $user = User::find($requestQuote->user_id);
        ProjectCommission::create([
            'project_id' => $project->id,
            'user_id' => $project->user_id,
            'commission_amount' => $requestQuote->getTotalPriceAttribute() * $user->default_commission_percent / 100,
            'commission_percent' => $user->default_commission_percent,
            'commission_paid_amount' => 0,
        ]);

    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(): void
    {
        // Logic to execute after a project is updated
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        ProjectCommission::where('project_id', $project->id)->delete();
    }
}
