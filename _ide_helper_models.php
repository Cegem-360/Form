<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ContactChannelFactory factory($count = null, $state = [])
 * @method static Builder<static>|ContactChannel newModelQuery()
 * @method static Builder<static>|ContactChannel newQuery()
 * @method static Builder<static>|ContactChannel query()
 * @method static Builder<static>|ContactChannel whereCreatedAt($value)
 * @method static Builder<static>|ContactChannel whereId($value)
 * @method static Builder<static>|ContactChannel whereName($value)
 * @method static Builder<static>|ContactChannel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ContactChannel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FormQuestion|null $formQuestion
 * @method static \Database\Factories\DomainFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereUrl($value)
 * @mixin \Eloquent
 */
	class Domain extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $domain_id
 * @property int|null $project_id
 * @property string|null $token
 * @property string|null $company_name
 * @property string|null $contact_name
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property string|null $contact_positsion
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereContactPositsion($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormQuestion whereVisualFeeling($value)
 */
	class FormQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read FormQuestion|null $formQuestion
 * @method static FormQuestionVisibilityFactory factory($count = null, $state = [])
 * @method static Builder<static>|FormQuestionVisibility newModelQuery()
 * @method static Builder<static>|FormQuestionVisibility newQuery()
 * @method static Builder<static>|FormQuestionVisibility query()
 * @method static Builder<static>|FormQuestionVisibility whereActivitiesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereAdditionalColorsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereBannedElementsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereBrutoNettoVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereCallToActionsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereCompanyNameVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereContactEmailVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereContactNameVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereContactPhoneVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereContactPositionVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereContractedAccountantsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereCreatedAt($value)
 * @method static Builder<static>|FormQuestionVisibility whereDeadlineVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereDesignFilesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereExistBlogCountVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereExistWebsiteUrlVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereFormQuestionId($value)
 * @method static Builder<static>|FormQuestionVisibility whereFormatingMilestoneVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveBlogVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveContractedAccountantVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveContractedOnlineBankCardPaymentVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveExistDesignVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveExistWebsiteVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHavePayedAdvertisingVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHaveProductCatalogVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereHighlightedCategoriesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereId($value)
 * @method static Builder<static>|FormQuestionVisibility whereImportanceOfSeoVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereInspireWebsitesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereIsExactDeadlineVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereLanguagesForWebsiteVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereLogoVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereMainPagesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereNeedMultiLanguageVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOnlineBankCardPaymentOptionsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOtherExpectationOrRequestVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOtherPagesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOtherToneOfWebsiteVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOwnCompanyImagesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereOwnCompanyVideosVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereParcelPointsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility wherePaymentMethodsVisible($value)
 * @method static Builder<static>|FormQuestionVisibility wherePreferedFontTypesVisible($value)
 * @method static Builder<static>|FormQuestionVisibility wherePrimaryColorVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereProductCatalogVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereProductsCsvFileVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereSecondaryColorVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereShippingAddressVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereStoreAddressVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereTokenVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereToneOfWebsiteVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereUpdatedAt($value)
 * @method static Builder<static>|FormQuestionVisibility whereUseVideoOrAnimationVisible($value)
 * @method static Builder<static>|FormQuestionVisibility whereVisualFeelingVisible($value)
 * @mixin \Eloquent
 */
	class FormQuestionVisibility extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static IdeaFactory factory($count = null, $state = [])
 * @method static Builder<static>|Idea newModelQuery()
 * @method static Builder<static>|Idea newQuery()
 * @method static Builder<static>|Idea query()
 * @method static Builder<static>|Idea whereCreatedAt($value)
 * @method static Builder<static>|Idea whereDescription($value)
 * @method static Builder<static>|Idea whereId($value)
 * @method static Builder<static>|Idea whereName($value)
 * @method static Builder<static>|Idea whereProjectId($value)
 * @method static Builder<static>|Idea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Idea extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $stripe_order_id
 * @property int $amount
 * @property \App\Enums\StripeCurrency $currency
 * @property \App\Enums\TransactionStatus $status
 * @property string|null $customer_email
 * @property string|null $customer_name
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStripeOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property string $product_name
 * @property string|null $product_description
 * @property int $price
 * @property int $quantity
 * @property string $currency
 * @property string|null $stripe_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order|null $order
 * @method static \Database\Factories\OrderItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $stripe_product_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $request_quote_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \App\Enums\ProjectStatus $status
 * @property string|null $project_goal
 * @property array<array-key, mixed>|null $original_project_goals
 * @property array<array-key, mixed>|null $completed_project_elements
 * @property array<array-key, mixed>|null $project_not_contained_elements
 * @property array<array-key, mixed>|null $completed_elements
 * @property array<array-key, mixed>|null $solved_problems
 * @property int|null $garanty
 * @property string|null $garanty_end_date
 * @property \App\Models\User|null $contact
 * @property int|null $support_pack_id
 * @property int|null $contact_channel_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ContactChannel|null $contactChannel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormQuestion> $formQuestions
 * @property-read int|null $form_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Idea> $ideas
 * @property-read int|null $ideas_count
 * @property-read \App\Models\RequestQuote|null $requestQuote
 * @property-read \App\Models\SupportPack|null $supportPack
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedProjectElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContactChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGaranty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGarantyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereOriginalProjectGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectNotContainedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereRequestQuoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSolvedProblems($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSupportPackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUserId($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $quotation_name
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property \App\Enums\ClientType|null $client_type
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $project_description
 * @property int $website_type_id
 * @property string|null $website_engine
 * @property array<array-key, mixed>|null $websites
 * @property bool|null $have_website_graphic
 * @property bool|null $is_multilangual
 * @property array<array-key, mixed>|null $languages
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int $total_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuoteFunctionality> $requestQuoteFunctionalities
 * @property-read int|null $request_quote_functionalities_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\WebsiteType|null $websiteType
 * @method static \Database\Factories\RequestQuoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereClientType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereHaveWebsiteGraphic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereIsMultilangual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereProjectDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereQuotationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereWebsiteEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereWebsiteTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote whereWebsites($value)
 */
	class RequestQuote extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int|null $price
 * @property string|null $description
 * @property int $website_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuote> $requestQuotes
 * @property-read int|null $request_quotes_count
 * @property-read \App\Models\WebsiteType|null $websiteType
 * @method static \Database\Factories\RequestQuoteFunctionalityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuoteFunctionality whereWebsiteTypeId($value)
 */
	class RequestQuoteFunctionality extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $stripe_product_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StripeProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StripeProduct whereUpdatedAt($value)
 */
	class StripeProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static SupportPackFactory factory($count = null, $state = [])
 * @method static Builder<static>|SupportPack newModelQuery()
 * @method static Builder<static>|SupportPack newQuery()
 * @method static Builder<static>|SupportPack query()
 * @method static Builder<static>|SupportPack whereCreatedAt($value)
 * @method static Builder<static>|SupportPack whereId($value)
 * @method static Builder<static>|SupportPack whereName($value)
 * @method static Builder<static>|SupportPack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SupportPack extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $form_field_name
 * @property int $form_field_id
 * @property OpenAIRole $role
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static SystemChatParameterFactory factory($count = null, $state = [])
 * @method static Builder<static>|SystemChatParameter newModelQuery()
 * @method static Builder<static>|SystemChatParameter newQuery()
 * @method static Builder<static>|SystemChatParameter query()
 * @method static Builder<static>|SystemChatParameter whereContent($value)
 * @method static Builder<static>|SystemChatParameter whereCreatedAt($value)
 * @method static Builder<static>|SystemChatParameter whereFormFieldId($value)
 * @method static Builder<static>|SystemChatParameter whereFormFieldName($value)
 * @method static Builder<static>|SystemChatParameter whereId($value)
 * @method static Builder<static>|SystemChatParameter whereRole($value)
 * @method static Builder<static>|SystemChatParameter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SystemChatParameter extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $company_vat_number
 * @property string|null $company_registration_number
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User hasExpiredGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompanyRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompanyVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePmLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser, \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WebsiteLanguageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteLanguage whereUpdatedAt($value)
 */
	class WebsiteLanguage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuoteFunctionality> $requestQuoteFunctionalities
 * @property-read int|null $request_quote_functionalities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuote> $requestQuotes
 * @property-read int|null $request_quotes_count
 * @method static \Database\Factories\WebsiteTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType whereUpdatedAt($value)
 */
	class WebsiteType extends \Eloquent {}
}

