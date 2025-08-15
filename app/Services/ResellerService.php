<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\RolesEnum;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectCommission;
use App\Models\RequestQuote;
use App\Models\User;
use Illuminate\Support\Facades\Log;

final class ResellerService
{
    /**
     * Ha egy reseller által létrehozott árajánlat (RequestQuote) sikeresen kifizetésre kerül,
     * akkor létrehoz egy jutalékot (ProjectCommission) a projekthez.
     */
    public function createCommissionIfReseller(Order $order): void
    {
        $requestQuote = $order->requestQuote;
        if (! $requestQuote) {
            return;
        }

        $user = $requestQuote->user;
        if (! $user || ! $user->hasRole(RolesEnum::RESELLER->value)) {
            return;
        }

        // Project keresése az árajánlat alapján
        $project = Project::where('request_quote_id', $requestQuote->id)->first();
        if (! $project) {
            return;
        }

        // Ha már van jutalék, ne hozzunk létre újat
        if (ProjectCommission::where('project_id', $project->id)->where('user_id', $user->id)->exists()) {
            return;
        }

        // Jutalék számítása (alapértelmezett: user default_commission_percent vagy 10%)
        $percent = $user->default_commission_percent ?? 10;
        $commissionAmount = (int) round($order->amount * ($percent / 100));

        ProjectCommission::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'commission_amount' => $commissionAmount,
            'commission_percent' => $percent,
            'commission_paid_amount' => 0,
        ]);

        Log::info('Reseller commission created', [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'commission_amount' => $commissionAmount,
            'commission_percent' => $percent,
        ]);
    }
}
