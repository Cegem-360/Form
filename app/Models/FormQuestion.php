<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FormQuestionStatus;
use App\Observers\FormQuestionObserver;
use Database\Factories\FormQuestionFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(FormQuestionObserver::class)]

final class FormQuestion extends Model
{
    /** @use HasFactory<FormQuestionFactory> */
    use HasFactory;

    protected $fillable = [

        // base informations
        'user_id',
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

        // theme

        'have_exist_website',
        'exist_website_url',
        'is_exact_deadline',
        'deadline',
        'formating_milestone',
        'visual_fealing',
        'tone_of_website',

        'have_exist_design',
        'design_files',

        'banned_elements',
        'primary_color',
        'secondary_color',
        'additional_colors',
        'prefered_font_types',

        // pages

        'own_company_images',
        'use_video_or_animation',
        'own_company_videos',
        'main_pages',

        'have_product_catalog',
        'product_catalog',
        'need_multi_language',
        'languages_for_website',
        'call_to_actions',
        'have_blog',
        'exist_blog_count',
        'importance_of_seo', // default false
        'have_payed_advertising',
        'other_expectation_or_request',

        // webshop

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
        'status',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visibility(): HasOne
    {
        return $this->hasOne(FormQuestionVisibility::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function projectQuoteFunctionalities(): Collection
    {
        return $this->project->requestQuote->requestQuoteFunctionalities;
    }

    protected function casts(): array
    {
        return [
            // bools
            'have_exist_website' => 'boolean',
            'is_exact_deadline' => 'boolean',
            'have_exist_design' => 'boolean',
            'use_video_or_animation' => 'boolean',
            'have_product_catalog' => 'boolean',
            'need_multi_language' => 'boolean',
            'have_blog' => 'boolean',
            'have_payed_advertising' => 'boolean',
            'have_contracted_accountant' => 'boolean',
            'have_contracted_online_bank_card_payment' => 'boolean',
            // arrays
            'activities' => 'array',
            'design_files' => 'array',

            'banned_elements' => 'array',
            'additional_colors' => 'array',
            'prefered_font_types' => 'array',
            'own_company_images' => 'array',
            'own_company_videos' => 'array',
            'main_pages' => 'array',
            'product_catalog' => 'array',
            'call_to_actions' => 'array',
            'languages_for_website' => 'array',

            // dates
            'deadline' => 'date',

            // webshop

            'products_csv_file' => 'array',
            'highlighted_categories' => 'array',
            'parcel_points' => 'array',
            'contracted_accountants' => 'array',
            'payment_methods' => 'array',
            'online_bank_card_payment_options' => 'array',
            'status' => FormQuestionStatus::class,

        ];
    }
}
