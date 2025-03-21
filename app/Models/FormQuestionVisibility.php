<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormQuestionVisibility extends Model
{
    /** @use HasFactory<\Database\Factories\FormQuestionVisibilityFactory> */
    use HasFactory;

    protected $fillable = [

        // base informations

        'form_question_id',
        'token_visible',
        'company_name_visible',
        'contact_name_visible',
        'contact_email_visible',
        'contact_phone_visible',
        'contact_position_visible',
        'logo_visible',
        'activities_visible',

        // theme

        'have_exist_website_visible',
        'exist_website_url_visible',
        'is_exact_deadline_visible',
        'deadline_visible',
        'formating_milestone_visible',
        'visual_feeling_visible',
        'tone_of_website_visible',
        'other_tone_of_website_visible',
        'have_exist_design_visible',
        'design_files_visible',
        'inspire_websites_visible',
        'banned_elements_visible',
        'primary_color_visible',
        'secondary_color_visible',
        'additional_colors_visible',
        'prefered_font_types_visible',

        // pages

        'own_company_images_visible',
        'use_video_or_animation_visible',
        'own_company_videos_visible',
        'main_pages_visible',
        'other_pages_visible',
        'have_product_catalog_visible',
        'product_catalog_visible',
        'need_multi_language_visible',
        'languages_for_website_visible',
        'call_to_actions_visible',
        'have_blog_visible',
        'exist_blog_count_visible',
        'importance_of_seo_visible',
        'have_payed_advertising_visible',
        'other_expectation_or_request_visible',

        // webshop
        'products_csv_file_visible',
        'highlighted_categories_visible',
        'bruto_netto_visible',
        'store_address_visible',
        'shipping_address_visible',
        'parcel_points_visible',
        'have_contracted_accountant_visible',
        'contracted_accountants_visible',
        'payment_methods_visible',
        'have_contracted_online_bank_card_payment_visible',
        'online_bank_card_payment_options_visible',
    ];

    public function casts(): array
    {
        return [
            'token_visible' => 'boolean',
            'company_name_visible' => 'boolean',
            'contact_name_visible' => 'boolean',
            'contact_email_visible' => 'boolean',
            'contact_phone_visible' => 'boolean',
            'contact_position_visible' => 'boolean',
            'logo_visible' => 'boolean',
            'activities_visible' => 'boolean',

            // theme

            'have_exist_website_visible' => 'boolean',
            'exist_website_url_visible' => 'boolean',
            'is_exact_deadline_visible' => 'boolean',
            'deadline_visible' => 'boolean',
            'formating_milestone_visible' => 'boolean',
            'visual_feeling_visible' => 'boolean',
            'tone_of_website_visible' => 'boolean',
            'other_tone_of_website_visible' => 'boolean',
            'have_exist_design_visible' => 'boolean',
            'design_files_visible' => 'boolean',
            'inspire_websites_visible' => 'boolean',
            'banned_elements_visible' => 'boolean',
            'primary_color_visible' => 'boolean',
            'secondary_color_visible' => 'boolean',
            'additional_colors_visible' => 'boolean',
            'prefered_font_types_visible' => 'boolean',

            // pages

            'own_company_images_visible' => 'boolean',
            'use_video_or_animation_visible' => 'boolean',
            'own_company_videos_visible' => 'boolean',
            'main_pages_visible' => 'boolean',
            'other_pages_visible' => 'boolean',
            'have_product_catalog_visible' => 'boolean',
            'product_catalog_visible' => 'boolean',
            'need_multi_language_visible' => 'boolean',
            'languages_for_website_visible' => 'boolean',
            'call_to_actions_visible' => 'boolean',
            'have_blog_visible' => 'boolean',
            'exist_blog_count_visible' => 'boolean',
            'importance_of_seo_visible' => 'boolean',
            'have_payed_advertising_visible' => 'boolean',
            'other_expectation_or_request_visible' => 'boolean',

            // webshop
            'products_csv_file_visible' => 'boolean',
            'highlighted_categories_visible' => 'boolean',
            'bruto_netto_visible' => 'boolean',
            'store_address_visible' => 'boolean',
            'shipping_address_visible' => 'boolean',
            'parcel_points_visible' => 'boolean',
            'have_contracted_accountant_visible' => 'boolean',
            'contracted_accountants_visible' => 'boolean',
            'payment_methods_visible' => 'boolean',
            'have_contracted_online_bank_card_payment_visible' => 'boolean',
            'online_bank_card_payment_options_visible' => 'boolean',

        ];
    }

    public function formQuestion(): BelongsTo
    {
        return $this->belongsTo(FormQuestion::class);
    }
}
