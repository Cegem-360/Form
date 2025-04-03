<?php

declare(strict_types=1);

use App\Models\Domain;
use App\Models\FormQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('has fillable attributes', function () {
    $form = new FormQuestion;

    $expected = [
        'domain_id',
        'project_id',
        'token',
        'company_name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_positsion',
        'logo',
        'activities',
        'have_exist_website',
        'exist_website_url',
        'is_exact_deadline',
        'deadline',
        'formating_milestone',
        'visual_fealing',
        'tone_of_website',
        'other_tone_of_website',
        'have_exist_design',
        'design_files',
        'inspire_websites',
        'banned_elements',
        'primary_color',
        'secondary_color',
        'additional_colors',
        'prefered_font_types',
        'own_company_images',
        'use_video_or_animation',
        'own_company_videos',
        'main_pages',
        'other_pages',
        'have_product_catalog',
        'product_catalog',
        'need_multi_language',
        'languages_for_website',
        'call_to_actions',
        'have_blog',
        'exist_blog_count',
        'importance_of_seo',
        'have_payed_advertising',
        'other_expectation_or_request',
        'products_csv_file',
        'highlighted_categories',
        'bruto_netto',
        'store_address',
        'shipping_address',
        'parcel_points',
        'have_contracted_accountant',
        'contracted_accountants',
        'payment_methods',
        'have_contracted_online_bank_card_payment',
        'online_bank_card_payment_options',
    ];

    expect($form->getFillable())->toEqual($expected);
});

it('belongs to a domain', function () {
    $domain = Domain::factory()->create();
    $form = FormQuestion::factory()->create(['domain_id' => $domain->id]);

    expect($form->domain()->first())->toBeInstanceOf(Domain::class);
    expect($form->domain()->first()->id)->toBe($domain->id);
});

it('can generate a token', function () {
    $form = FormQuestion::factory()->create();
    $form->token = Str::random(60);
    $form->save();

    expect($form->token)->toHaveLength(60);
});

it('can fill name field', function () {
    $form = FormQuestion::factory()->create(['contact_name' => 'Test Name']);

    expect($form->contact_name)->toBe('Test Name');
});

it('can fill email field', function () {
    $form = FormQuestion::factory()->create(['contact_email' => 'test@example.com']);

    expect($form->contact_email)->toBe('test@example.com');
});

it('can fill phone field', function () {
    $form = FormQuestion::factory()->create(['contact_phone' => '123456789']);

    expect($form->contact_phone)->toBe('123456789');
});
