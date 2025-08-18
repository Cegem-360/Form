<?php

declare(strict_types=1);

use App\Enums\ClientType;
use App\Jobs\SendRequestQuoteToNotion;
use App\Listeners\SendRequestQuoteToNotionListener;
use App\Models\RequestQuote;
use App\Models\RequestQuoteFunctionality;
use App\Models\WebsiteLanguage;
use App\Models\WebsiteType;
use App\Services\NotionService;
use Illuminate\Support\Facades\Queue;

/*
beforeEach(function (): void {
    Queue::fake();
    Event::fake();

    // Hozzunk létre szükséges adatokat
    $this->websiteType = WebsiteType::factory()->create([
        'name' => 'weboldal',
    ]);

    $this->defaultLanguage = WebsiteLanguage::factory()->create([
        'name' => 'Magyar',
        'code' => 'hu',
    ]);

    $this->secondLanguage = WebsiteLanguage::factory()->create([
        'name' => 'English',
        'code' => 'en',
    ]);

    $this->listener = new SendRequestQuoteToNotionListener(new NotionService);
});

it('creates RequestQuote and automatically triggers Notion integration via Observer', function (): void {
    // Act - RequestQuote létrehozása automatikusan aktiválja az Observer-t
    $requestQuote = RequestQuote::create([
        'name' => 'Integration Test Ügyfél',
        'email' => 'integration@test.com',
        'phone' => '+36301234567',
        'quotation_name' => 'Integration Test Ajánlat',
        'client_type' => ClientType::INDIVIDUAL,
        'website_type_id' => $this->websiteType->id,
        'website_engine' => 'WordPress',
        'have_website_graphic' => true,
        'is_multilangual' => false,
        'default_language' => $this->defaultLanguage->id,
        'payment_method' => 'Bankkártya',
        'project_description' => 'Ez egy teljes integrációs teszt projekt.',
        'billing_address' => '1234 Budapest, Teszt utca 1.',
        'is_payed' => false,
    ]);

    // Assert
    expect($requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($requestQuote->name)->toBe('Integration Test Ügyfél');
    expect($requestQuote->email)->toBe('integration@test.com');
    expect($requestQuote->client_type)->toBe(ClientType::INDIVIDUAL);

    // Ellenőrizzük, hogy a Notion integráció Job elindult
    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('handles RequestQuote with functionalities and calculates total price', function (): void {
    // Arrange
    $functionality1 = RequestQuoteFunctionality::factory()->create([
        'name' => 'SEO optimalizálás',
        'price' => 50000,
        'website_type_id' => $this->websiteType->id,
    ]);
    $functionality2 = RequestQuoteFunctionality::factory()->create([
        'name' => 'Kosár funkció',
        'price' => 75000,
        'website_type_id' => $this->websiteType->id,
    ]);

    // Act
    $requestQuote = RequestQuote::create([
        'name' => 'Functionality Test',
        'email' => 'functionality@test.com',
        'quotation_name' => 'Webshop with Features',
        'client_type' => ClientType::COMPANY,
        'company_name' => 'Test Company Kft.',
        'website_type_id' => $this->websiteType->id,
        'website_engine' => 'Laravel',
        'default_language' => $this->defaultLanguage->id,
        'websites' => [
            ['length' => 'medium', 'required' => true],
        ],
        'project_description' => 'Test project',
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    // Funkciók hozzáadása
    $requestQuote->requestQuoteFunctionalities()->attach([
        $functionality1->id,
        $functionality2->id,
    ]);

    // Frissítjük a RequestQuote-ot hogy triggereljeük az updated observer-t
    $requestQuote->update(['project_description' => 'Updated description']);

    // Assert
    expect($requestQuote->requestQuoteFunctionalities)->toHaveCount(2);
    expect($requestQuote->requestQuoteFunctionalities->sum('price'))->toBe(125000);

    // Observer aktiválódott a created és updated eseményeknél is
    Queue::assertPushed(SendRequestQuoteToNotion::class, 2);
});

it('creates RequestQuote with multilingual settings', function (): void {
    // Act
    $requestQuote = RequestQuote::create([
        'name' => 'Multilingual Test',
        'email' => 'multi@test.com',
        'quotation_name' => 'Multilingual Landing Page',
        'client_type' => ClientType::COMPANY,
        'company_name' => 'International Corp.',
        'website_type_id' => $this->websiteType->id,
        'website_engine' => 'Webflow',
        'have_website_graphic' => false,
        'is_multilangual' => true,
        'default_language' => $this->defaultLanguage->id,
        'languages' => [$this->secondLanguage->name],
        'project_description' => 'Multi-language landing page for international audience.',
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    // Assert
    expect($requestQuote->is_multilangual)->toBeTrue();
    expect($requestQuote->languages)->toBeArray();
    expect($requestQuote->languages)->toHaveCount(1);
    expect($requestQuote->languages)->toContain('en');
    expect($requestQuote->default_language)->toBe($this->defaultLanguage->id);

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id &&
               $job->requestQuote->is_multilangual === true &&
               is_array($job->requestQuote->languages);
    });
});

it('handles RequestQuote creation with minimal required data', function (): void {
    // Act - Csak a minimális adatokkal
    $requestQuote = RequestQuote::create([
        'name' => 'Minimal Data Test',
        'website_type_id' => $this->websiteType->id,
        'default_language' => $this->defaultLanguage->id,
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    // Assert
    expect($requestQuote)->toBeInstanceOf(RequestQuote::class);
    expect($requestQuote->name)->toBe('Minimal Data Test');
    expect($requestQuote->email)->toBeNull();
    expect($requestQuote->client_type)->toBeNull();
    expect($requestQuote->is_payed)->toBeFalse();

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote): bool {
        return $job->requestQuote->id === $requestQuote->id;
    });
});

it('multiple RequestQuote creations trigger multiple Notion integrations', function (): void {
    // Act
    $requestQuote1 = RequestQuote::create([
        'name' => 'Batch Test 1',
        'email' => 'batch1@test.com',
        'website_type_id' => $this->websiteType->id,
        'default_language' => $this->defaultLanguage->id,
        'client_type' => ClientType::INDIVIDUAL,
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    $requestQuote2 = RequestQuote::create([
        'name' => 'Batch Test 2',
        'email' => 'batch2@test.com',
        'website_type_id' => $this->websiteType->id,
        'default_language' => $this->defaultLanguage->id,
        'client_type' => ClientType::COMPANY,
        'company_name' => 'Batch Company',
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    $requestQuote3 = RequestQuote::create([
        'name' => 'Batch Test 3',
        'email' => 'batch3@test.com',
        'website_type_id' => $this->websiteType->id,
        'default_language' => $this->defaultLanguage->id,
        'payment_method' => 'stripe',
        'is_payed' => false,
    ]);

    // Assert
    expect(RequestQuote::count())->toBe(3);

    Queue::assertPushed(SendRequestQuoteToNotion::class, 3);

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote1): bool {
        return $job->requestQuote->id === $requestQuote1->id;
    });

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote2): bool {
        return $job->requestQuote->id === $requestQuote2->id;
    });

    Queue::assertPushed(SendRequestQuoteToNotion::class, function ($job) use ($requestQuote3): bool {
        return $job->requestQuote->id === $requestQuote3->id;
    });
}); */
/*
it('RequestQuote update also triggers Notion sync', function (): void {

    $requestQuote = RequestQuote::factory()->create([
        'name' => 'Update Test',
        'email' => 'update@test.com',
    ]);

    // Első létrehozás már triggert egy job-ot
    Queue::assertPushed(SendRequestQuoteToNotion::class, 1);

    // Act - Frissítés
    $requestQuote->update([
        'project_description' => 'Updated project description',
        'is_payed' => true,
    ]);

    // Assert - A frissítés újabb job-ot triggerel
    Queue::assertPushed(SendRequestQuoteToNotion::class, 2);

    expect($requestQuote->fresh()->project_description)->toBe('Updated project description');
    expect($requestQuote->fresh()->is_payed)->toBeTrue();
}); */
