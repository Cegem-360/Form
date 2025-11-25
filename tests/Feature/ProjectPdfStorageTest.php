<?php

declare(strict_types=1);

use App\Models\Project;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('can access project pdf storage route', function (): void {
    $user = User::factory()->create();
    $project = Project::factory()->create();

    actingAs($user);

    $response = get('/project-pdf/storage/'.$project->id);

    // This will help us see what exactly happens
    if ($response->status() !== 200) {
        dump($response->status());
        dump($response->getContent());
    }

    $response->assertStatus(200);
});
