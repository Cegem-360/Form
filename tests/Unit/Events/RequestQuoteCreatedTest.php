<?php

declare(strict_types=1);

use App\Enums\ClientType;
use App\Events\RequestQuoteCreated;
use App\Jobs\SendRequestQuoteToNotion;
use App\Listeners\SendRequestQuoteToNotionListener;
use App\Models\RequestQuote;
use App\Models\WebsiteType;
use App\Services\NotionService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

beforeEach(function (): void {
    Event::fake();
    Queue::fake();

    // Mock NotionService
    $notionServiceMock = Mockery::mock(NotionService::class);
    $notionServiceMock->shouldReceive('saveFormQuoteToNotion')
        ->andReturn(['success' => true, 'page_id' => 'test-page-id']);

    $this->listener = new SendRequestQuoteToNotionListener($notionServiceMock);
});

it('RequestQuoteCreated event can be dispatched', function (): void {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Event Test',
        'email' => 'event@test.com',
    ]);

    // Act
    event(new RequestQuoteCreated($requestQuote));

    // Assert
    Event::assertDispatched(RequestQuoteCreated::class, function ($event) use ($requestQuote): bool {
        return $event->requestQuote->id === $requestQuote->id;
    });
});

it('listener handles RequestQuoteCreated event and dispatches job', function (): void {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Listener Test',
        'email' => 'listener@test.com',
    ]);

    $event = new RequestQuoteCreated($requestQuote);

    // Act
    $this->listener->handle($event);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('listener handles event with complex RequestQuote data', function (): void {
    // Arrange
    $websiteType = WebsiteType::factory()->create(['name' => 'E-commerce']);
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Complex Event Test',
        'email' => 'complex@test.com',
        'phone' => '+36301234567',
        'quotation_name' => 'E-commerce Platform',
        'client_type' => ClientType::COMPANY,
        'company_name' => 'Tech Solutions Ltd.',
        'website_type_id' => $websiteType->id,
        'website_engine' => 'Laravel',
        'have_website_graphic' => true,
        'is_multilangual' => true,
        'languages' => ['hu', 'en', 'de'],
        'project_description' => 'Multi-language e-commerce platform with custom features.',
    ]);

    $event = new RequestQuoteCreated($requestQuote);

    // Act
    $this->listener->handle($event);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id &&
               $job->requestQuote->name === 'Complex Event Test' &&
               $job->requestQuote->client_type === ClientType::COMPANY;
    });
});

it('RequestQuoteCreated event contains correct data', function (): void {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Data Test',
        'email' => 'data@test.com',
        'quotation_name' => 'Data Validation Test',
    ]);

    // Act
    $event = new RequestQuoteCreated($requestQuote);

    // Assert
    expect($event->requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($event->requestQuote->id)->toBe($requestQuote->id);
    expect($event->requestQuote->name)->toBe('Data Test');
    expect($event->requestQuote->email)->toBe('data@test.com');
    expect($event->requestQuote->quotation_name)->toBe('Data Validation Test');
});

it('listener works with minimal RequestQuote data', function (): void {
    // Arrange
    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Minimal Event Test',
        'email' => null,
        'phone' => null,
        'website_type_id' => null,
    ]);

    $event = new RequestQuoteCreated($requestQuote);

    // Act
    $this->listener->handle($event);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id &&
               $job->requestQuote->name === 'Minimal Event Test';
    });
});

it('multiple events dispatch multiple jobs', function (): void {
    // Arrange
    $requestQuote1 = RequestQuote::factory()->create(['name' => 'Event Test 1']);
    $requestQuote2 = RequestQuote::factory()->create(['name' => 'Event Test 2']);

    $event1 = new RequestQuoteCreated($requestQuote1);
    $event2 = new RequestQuoteCreated($requestQuote2);

    // Act
    $this->listener->handle($event1);
    $this->listener->handle($event2);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, 2);

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote1): bool {
        return $job->requestQuote->id === $requestQuote1->id;
    });

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote2): bool {
        return $job->requestQuote->id === $requestQuote2->id;
    });
});

afterEach(function (): void {
    Mockery::close();
});
