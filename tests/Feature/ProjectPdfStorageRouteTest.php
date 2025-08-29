<?php

declare(strict_types=1);

use App\Models\Project;
use App\Models\User;
use App\Services\ProjectCompletionDocumentService;

it('can download project completion pdf from storage', function (): void {
    // Create test data
    $user = User::factory()->create();
    $project = Project::factory()->create();

    // Generate the PDF file first
    $service = new ProjectCompletionDocumentService($project);
    $filename = $service->savePdfToStorage();

    // Test the route
    $response = $this->actingAs($user)
        ->get('/project-pdf/storage/'.$project->id);

    $response->assertStatus(200)
        ->assertHeader('Content-Type', 'application/pdf');
});
