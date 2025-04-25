<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $form_question_id
 * @property bool $token_visible
 * @property bool $company_name_visible
 * @property bool $contact_name_visible
 * @property bool $contact_email_visible
 * @property bool $contact_phone_visible
 * @property bool $logo_visible
 * @property bool $activities_visible
 * @property bool $contact_position_visible
 * @property bool $have_exist_website_visible
 * @property bool $exist_website_url_visible
 * @property bool $is_exact_deadline_visible
 * @property bool $deadline_visible
 * @property bool $formating_milestone_visible
 * @property bool $visual_feeling_visible
 * @property bool $have_exist_design_visible
 * @property bool $design_files_visible
 * @property bool $inspire_websites_visible
 * @property bool $banned_elements_visible
 * @property bool $primary_color_visible
 * @property bool $secondary_color_visible
 * @property bool $additional_colors_visible
 * @property bool $prefered_font_types_visible
 * @property bool $own_company_images_visible
 * @property bool $use_video_or_animation_visible
 * @property bool $own_company_videos_visible
 * @property bool $main_pages_visible
 * @property bool $other_pages_visible
 * @property bool $have_product_catalog_visible
 * @property bool $product_catalog_visible
 * @property bool $tone_of_website_visible
 * @property bool $other_tone_of_website_visible
 * @property bool $need_multi_language_visible
 * @property bool $languages_for_website_visible
 * @property bool $call_to_actions_visible
 * @property bool $have_blog_visible
 * @property bool $exist_blog_count_visible
 * @property bool $importance_of_seo_visible
 * @property bool $have_payed_advertising_visible
 * @property bool $other_expectation_or_request_visible
 * @property bool $products_csv_file_visible
 * @property bool $highlighted_categories_visible
 * @property bool $bruto_netto_visible
 * @property bool $store_address_visible
 * @property bool $shipping_address_visible
 * @property bool $parcel_points_visible
 * @property bool $have_contracted_accountant_visible
 * @property bool $contracted_accountants_visible
 * @property bool $payment_methods_visible
 * @property bool $have_contracted_online_bank_card_payment_visible
 * @property bool $online_bank_card_payment_options_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FormQuestion|null $formQuestion
 *
 * @method static \Database\Factories\FormQuestionVisibilityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereActivitiesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereAdditionalColorsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereBannedElementsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereBrutoNettoVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereCallToActionsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereCompanyNameVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereContactEmailVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereContactNameVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereContactPhoneVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereContactPositionVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereContractedAccountantsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereDeadlineVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereDesignFilesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereExistBlogCountVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereExistWebsiteUrlVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereFormQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereFormatingMilestoneVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveBlogVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveContractedAccountantVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveContractedOnlineBankCardPaymentVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveExistDesignVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveExistWebsiteVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHavePayedAdvertisingVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHaveProductCatalogVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereHighlightedCategoriesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereImportanceOfSeoVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereInspireWebsitesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereIsExactDeadlineVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereLanguagesForWebsiteVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereLogoVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereMainPagesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereNeedMultiLanguageVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOnlineBankCardPaymentOptionsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOtherExpectationOrRequestVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOtherPagesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOtherToneOfWebsiteVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOwnCompanyImagesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereOwnCompanyVideosVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereParcelPointsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility wherePaymentMethodsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility wherePreferedFontTypesVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility wherePrimaryColorVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereProductCatalogVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereProductsCsvFileVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereSecondaryColorVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereShippingAddressVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereStoreAddressVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereTokenVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereToneOfWebsiteVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereUseVideoOrAnimationVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestionVisibility whereVisualFeelingVisible($value)
 *
 * @mixin \Eloquent
 */
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

    protected function casts(): array
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
