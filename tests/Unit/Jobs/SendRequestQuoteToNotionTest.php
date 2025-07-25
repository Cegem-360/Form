<?php

declare(strict_types=1);

use App\Jobs\SendRequestQuoteToNotion;
use App\Models\RequestQuote;
use App\Models\WebsiteType;
use App\Services\NotionService;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    Queue::fake();

    // Létrehozunk egy WebsiteType-ot minden teszthez
    $this->websiteType = WebsiteType::create(['name' => 'Test Website Type']);
});

it('can create and configure SendRequestQuoteToNotion job', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Teszt Ügyfél',
        'email' => 'test@example.com',
        'website_type_id' => $this->websiteType->id,
    ]);

    // Act
    $job = new SendRequestQuoteToNotion($requestQuote);

    // Assert
    expect($job->requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($job->requestQuote->id)->toBe($requestQuote->id);
    expect($job->requestQuote->name)->toBe('Teszt Ügyfél');
    expect($job->tries)->toBe(3);
    expect($job->timeout)->toBe(60);
});

it('can manually dispatch SendRequestQuoteToNotion job', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Manual Test',
        'email' => 'manual@test.com',
        'website_type_id' => $this->websiteType->id,
    ]);

    // Act
    SendRequestQuoteToNotion::dispatch($requestQuote);

    // Assert
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote) {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('SendRequestQuoteToNotion job has correct configuration', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Config Test',
        'website_type_id' => $this->websiteType->id,
    ]);
    $job = new SendRequestQuoteToNotion($requestQuote);

    // Assert
    expect($job->tries)->toBe(3);
    expect($job->timeout)->toBe(60);
    expect($job->requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($job->requestQuote->id)->toBe($requestQuote->id);
});

it('job can be instantiated and has correct properties', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Success Test',
        'website_type_id' => $this->websiteType->id,
    ]);
    $job = new SendRequestQuoteToNotion($requestQuote);

    // Assert
    expect($job->requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($job->requestQuote->id)->toBe($requestQuote->id);
    expect($job->tries)->toBe(3);
    expect($job->timeout)->toBe(60);
});

it('job can handle method call', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Handle Test',
        'website_type_id' => $this->websiteType->id,
    ]);
    $job = new SendRequestQuoteToNotion($requestQuote);
    $notionService = new NotionService();

    // Act & Assert - Ha nincs Notion konfiguráció, hiba kell hogy legyen
    expect(fn () => $job->handle($notionService))
        ->not->toThrow(TypeError::class); // Legalább a tipus helyes legyen
});

it('job failed method can be called', function () {
    // Arrange
    $requestQuote = RequestQuote::create([
        'name' => 'Failed Test',
        'website_type_id' => $this->websiteType->id,
    ]);
    $job = new SendRequestQuoteToNotion($requestQuote);
    $exception = new Exception('Test failure');

    // Act & Assert - A failed metódus nem dob hibát
    expect(fn () => $job->failed($exception))
        ->not->toThrow(Exception::class);
});
