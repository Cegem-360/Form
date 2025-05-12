<?php

declare(strict_types=1);

use App\Models\User;

test('to array', function (): void {
    $user = User::factory()->create()->refresh();

    expect(array_keys($user->toArray()))
        ->toBe([
            'id',
            'name',
            'phone',
            'email',
            'email_verified_at',
            'company_name',
            'company_address',
            'company_vat_number',
            'company_registration_number',
            'created_at',
            'updated_at',
            'stripe_id',
            'pm_type',
            'pm_last_four',
            'trial_ends_at',
        ]);
});
