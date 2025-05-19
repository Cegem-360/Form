<?php

declare(strict_types=1);

use App\Enums\ClientType;
use App\Livewire\GuestShowQuaotationForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Livewire\livewire;

it('loads the guest show quotation form page and shows fields', function (): void {
    $response = $this->get(route('quotation')); // Állítsd be a helyes route-ot!
    $response->assertStatus(200);
    $response->assertSee('Weboldal típusa');
    $response->assertSee('Weboldal motorja');
});

it('renders the livewire component', function (): void {
    Livewire::test(GuestShowQuaotationForm::class)
        ->assertStatus(200)
        ->assertSee('Weboldal típusa');
});

it('fill the form', function (): void {
    Mail::fake();
    Notification::fake();

    Livewire::test(GuestShowQuaotationForm::class)
        ->assertStatus(200)
        ->assertSee('Weboldal típusa');
    // $clientType = fake()->randomElement(ClientType::cases());
    livewire(GuestShowQuaotationForm::class)
        ->assertFormExists()
        ->goToWizardStep(4)
        ->assertWizardCurrentStep(4)
        ->fillForm([
            'website_type_id' => '1',
            'website_engine' => 'Laravel',
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'client_type' => ClientType::INDIVIDUAL,
            'consent' => true,
            'privacy_policy' => true,
        ])
        ->call('sendEmailToMeAction')
        ->assertHasNoErrors();
});
