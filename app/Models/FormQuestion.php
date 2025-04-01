<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\FormQuestionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(FormQuestionObserver::class)]
/**
 * 
 *
 * @property int $id
 * @property int|null $domain_id
 * @property int|null $project_id
 * @property string|null $token
 * @property string|null $company_name
 * @property string|null $contact_name
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property string|null $contact_position
 * @property string|null $logo
 * @property array<array-key, mixed>|null $activities
 * @property bool $have_exist_website
 * @property string|null $exist_website_url
 * @property bool $is_exact_deadline
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property string|null $formating_milestone
 * @property string|null $visual_feeling
 * @property string|null $tone_of_website
 * @property string|null $other_tone_of_website
 * @property bool $have_exist_design
 * @property array<array-key, mixed>|null $design_files
 * @property array<array-key, mixed>|null $inspire_websites
 * @property array<array-key, mixed>|null $banned_elements
 * @property string|null $primary_color
 * @property string|null $secondary_color
 * @property array<array-key, mixed>|null $additional_colors
 * @property array<array-key, mixed>|null $prefered_font_types
 * @property array<array-key, mixed>|null $own_company_images
 * @property bool|null $use_video_or_animation
 * @property array<array-key, mixed>|null $own_company_videos
 * @property array<array-key, mixed>|null $main_pages
 * @property string|null $other_pages
 * @property bool $have_product_catalog
 * @property array<array-key, mixed>|null $product_catalog
 * @property bool|null $need_multi_language
 * @property string|null $languages_for_website
 * @property array<array-key, mixed>|null $call_to_actions
 * @property bool $have_blog
 * @property string|null $exist_blog_count
 * @property string|null $importance_of_seo
 * @property bool|null $have_payed_advertising
 * @property string|null $other_expectation_or_request
 * @property array<array-key, mixed>|null $products_csv_file
 * @property array<array-key, mixed>|null $highlighted_categories
 * @property string|null $bruto_netto
 * @property string|null $store_address
 * @property string|null $shipping_address
 * @property array<array-key, mixed>|null $parcel_points
 * @property bool $have_contracted_accountant
 * @property array<array-key, mixed>|null $contracted_accountants
 * @property array<array-key, mixed>|null $payment_methods
 * @property bool $have_contracted_online_bank_card_payment
 * @property array<array-key, mixed>|null $online_bank_card_payment_options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Domain|null $domain
 * @property-read \App\Models\Project|null $project
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\FormQuestionVisibility|null $visibility
 * @method static \Database\Factories\FormQuestionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereAdditionalColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereBannedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereBrutoNetto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereCallToActions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContactPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContractedAccountants($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereDesignFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereDomainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereExistBlogCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereExistWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereFormatingMilestone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveBlog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveContractedAccountant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveContractedOnlineBankCardPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveExistDesign($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveExistWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHavePayedAdvertising($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHaveProductCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereHighlightedCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereImportanceOfSeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereInspireWebsites($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereIsExactDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereLanguagesForWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereMainPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereNeedMultiLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOnlineBankCardPaymentOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOtherExpectationOrRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOtherPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOtherToneOfWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOwnCompanyImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereOwnCompanyVideos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereParcelPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion wherePaymentMethods($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion wherePreferedFontTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion wherePrimaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereProductCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereProductsCsvFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereSecondaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereStoreAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereToneOfWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereUseVideoOrAnimation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereVisualFeeling($value)
 * @mixin \Eloquent
 */
class FormQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\FormQuestionFactory> */
    use HasFactory;

    protected $fillable = [

        // base informations

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
        'other_tone_of_website',
        'have_exist_design',
        'design_files',
        'inspire_websites',
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
        'other_pages',
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
            'inspire_websites' => 'array',

            'banned_elements' => 'array',
            'additional_colors' => 'array',
            'prefered_font_types' => 'array',
            'own_company_images' => 'array',
            'own_company_videos' => 'array',
            'main_pages' => 'array',
            'product_catalog' => 'array',
            'call_to_actions' => 'array',

            // dates
            'deadline' => 'date',

            // webshop

            'products_csv_file' => 'array',
            'highlighted_categories' => 'array',
            'parcel_points' => 'array',
            'contracted_accountants' => 'array',
            'payment_methods' => 'array',
            'online_bank_card_payment_options' => 'array',

        ];
    }
}
