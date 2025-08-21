<?php

declare(strict_types=1);

use App\Enums\RolesEnum;
use App\Models\Option;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectCommission;
use App\Models\RequestQuote;
use App\Models\User;
use App\Models\WebsiteLanguage;
use App\Models\WebsiteType;
use Spatie\Permission\Models\Role;

describe('ResellerService', function (): void {
    beforeEach(function (): void {
        Option::query()->firstOrCreate([
            'name' => 'request_quote',
            'options' => [
                ['key' => 'language_percent', 'value' => 0.15],
            ],
        ]);
    });

    it('creates commission for reseller on successful payment', function (): void {
        Role::query()->firstOrCreate(['name' => RolesEnum::RESELLER]);
        // Szükséges kapcsolódó rekordok létrehozása
        $language = WebsiteLanguage::factory()->create();
        $websiteType = WebsiteType::factory()->create();
        $reseller = User::factory()->create();
        $reseller->assignRole(RolesEnum::RESELLER);
        $reseller->update(['default_commission_percent' => 15]);

        $requestQuote = RequestQuote::factory()->create([
            'user_id' => $reseller->id,
            'default_language' => null,
            'languages' => null,
            'website_type_id' => $websiteType->id,
        ]);
        $project = Project::factory()->create([
            'request_quote_id' => $requestQuote->id,
        ]);
        Order::factory()->create([
            'request_quote_id' => $requestQuote->id,
            'user_id' => $reseller->id,
            'amount' => 100000,
        ]);

        expect(ProjectCommission::query()
            ->where('project_id', $project->id)
            ->where('user_id', $reseller->id)
            ->where('commission_amount', 15000)
            ->where('commission_percent', 15.0)
            ->exists()
        )->toBeTrue();
    });

    it('does not create commission if not reseller', function (): void {
        // Szükséges kapcsolódó rekordok létrehozása
        $language = WebsiteLanguage::factory()->create();
        $websiteType = WebsiteType::factory()->create();
        $user = User::factory()->create();
        $requestQuote = RequestQuote::factory()->create([
            'user_id' => $user->id,
            'default_language' => $language->id,
            'languages' => [$language->name],
            'website_type_id' => $websiteType->id,
        ]);
        $project = Project::factory()->create([
            'request_quote_id' => $requestQuote->id,
        ]);
        Order::factory()->create([
            'request_quote_id' => $requestQuote->id,
            'user_id' => $user->id,
            'amount' => 100_000,
        ]);

        expect(ProjectCommission::query()
            ->where('project_id', $project->id)
            ->where('user_id', $user->id)
            ->exists()
        )->toBeFalse();
    });
});
