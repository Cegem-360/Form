<?php

declare(strict_types=1);

use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Livewire\livewire;

covers(User::class);

it('can render page', function (): void {
    // livewire(ListUsers::class)->assertSuccessful();
});
describe('User Model', function (): void {
    test('Admin can create a user', function (): void {
        $user = $this->createAdmin();
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user->id);
        Livewire::actingAs($user)->test(EditUser::class, ['record' => $user->id])->assertSuccessful();
        dump(User::all());
    });
});

describe('User Model', function (): void {
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
                'default_commission_percent',
                'created_at',
                'updated_at',
                'stripe_id',
                'pm_type',
                'pm_last_four',
                'trial_ends_at',

            ]);
    });

})->group('user');
