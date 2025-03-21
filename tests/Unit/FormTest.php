<?php

declare(strict_types=1);

use App\Models\Domain;
use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has fillable attributes', function () {
    $form = new Form;

    $expected = [
        'id',
        'domain_id',
        'user_id',
        'token',
        'name',
        'email',
        'phone',
        'company_name',
        'website',
        'introduction',
        'company_history',
        'company_mission',
        'company_goals',
        'presentation_text',
        'team_introduction',
        'company_values',
    ];

    expect($form->getFillable())->toEqual($expected);
});

it('belongs to a domain', function () {
    $domain = Domain::factory()->create();
    $form = Form::factory()->create(['domain_id' => $domain->id]);

    expect($form->domain()->first())->toBeInstanceOf(Domain::class);
    expect($form->domain()->first()->id)->toBe($domain->id);
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $form = Form::factory()->create(['user_id' => $user->id]);

    expect($form->user()->first())->toBeInstanceOf(User::class);
    expect($form->user()->first()->id)->toBe($user->id);
});

it('can generate a token', function () {
    $form = Form::factory()->create();
    $form->token = Str::random(60);
    $form->save();

    expect($form->token)->toHaveLength(60);
});

it('can fill name field', function () {
    $form = Form::factory()->create(['name' => 'Test Name']);

    expect($form->name)->toBe('Test Name');
});

it('can fill email field', function () {
    $form = Form::factory()->create(['email' => 'test@example.com']);

    expect($form->email)->toBe('test@example.com');
});

it('can fill phone field', function () {
    $form = Form::factory()->create(['phone' => '123456789']);

    expect($form->phone)->toBe('123456789');
});
