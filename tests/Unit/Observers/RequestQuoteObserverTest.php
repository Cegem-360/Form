<?php

declare(strict_types=1);

use App\Enums\ClientType;
use App\Jobs\SendRequestQuoteToNotion;
use App\Models\RequestQuote;
use App\Models\WebsiteType;
use App\Observers\RequestQuoteObserver;
use App\Services\NotionService;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    Queue::fake();

    // Mock NotionService a dependency injection miatt
    $notionServiceMock = Mockery::mock(NotionService::class);
    $notionServiceMock->shouldReceive('saveFormQuoteToNotion')
        ->andReturn(['success' => true, 'page_id' => 'test-page-id']);

    $this->observer = new RequestQuoteObserver($notionServiceMock);
});

it('observer dispatches job when RequestQuote is created', function () {
    // Arrange
    $websiteType = WebsiteType::factory()->create(['name' => 'Weboldal']);
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Observer Test',
        'email' => 'observer@test.com',
        'website_type_id' => $websiteType->id,
    ]);

    // Act
    $this->observer->created($requestQuote);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote) {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('observer dispatches job when RequestQuote is updated', function () {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@test.com',
    ]);

    // Act
    $this->observer->updated($requestQuote);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote) {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('observer handles RequestQuote with minimal data', function () {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Minimal Test',
        'email' => null,
        'phone' => null,
        'website_type_id' => null,
    ]);

    // Act
    $this->observer->created($requestQuote);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote) {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('observer handles RequestQuote with all fields', function () {
    // Arrange
    $websiteType = WebsiteType::factory()->create(['name' => 'Webshop']);
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Complete Test',
        'email' => 'complete@test.com',
        'phone' => '+36301234567',
        'quotation_name' => 'Complete Quotation',
        'client_type' => ClientType::COMPANY,
        'company_name' => 'Test Company Ltd.',
        'company_address' => '1234 Budapest, Test Street 1.',
        'website_type_id' => $websiteType->id,
        'website_engine' => 'WordPress',
        'have_website_graphic' => true,
        'is_multilangual' => true,
        'default_language' => 'hu',
        'languages' => ['en', 'de'],
        'payment_method' => 'Bankkártya',
        'project_description' => 'Complex website with multiple languages.',
        'billing_address' => '1234 Budapest, Billing Address 2.',
        'is_payed' => false,
    ]);

    // Act
    $this->observer->created($requestQuote);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote) {
        return $job->requestQuote->id === $requestQuote->id &&
               $job->requestQuote->name === 'Complete Test' &&
               $job->requestQuote->client_type === ClientType::COMPANY;
    });
});

it('multiple RequestQuote creations dispatch multiple jobs', function () {
    // Arrange & Act
    $requestQuote1 = RequestQuote::factory()->create(['name' => 'Test 1']);
    $requestQuote2 = RequestQuote::factory()->create(['name' => 'Test 2']);
    $requestQuote3 = RequestQuote::factory()->create(['name' => 'Test 3']);

    $this->observer->created($requestQuote1);
    $this->observer->created($requestQuote2);
    $this->observer->created($requestQuote3);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, 3);

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote1) {
        return $job->requestQuote->id === $requestQuote1->id;
    });

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote2) {
        return $job->requestQuote->id === $requestQuote2->id;
    });

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote3) {
        return $job->requestQuote->id === $requestQuote3->id;
    });
});

afterEach(function () {
    Mockery::close();
});
