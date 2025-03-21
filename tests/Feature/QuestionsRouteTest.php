<?php

declare(strict_types=1);

use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('questions route contains livewire component', function () {
    $token = Str::random(60);
    $form = Form::factory()->create(['token' => $token]);
    $response = $this->get('/questions/' . $token);

    $response->assertStatus(200);
    $response->assertSeeLivewire('your-livewire-component-name');
});
