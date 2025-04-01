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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ContactChannelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactChannel whereUpdatedAt($value)
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
 */
	class Domain extends \Eloquent {}
}

namespace App\Models{
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FormQuestion|null $formQuestion
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\IdeaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereUpdatedAt($value)
 */
	class Idea extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $name
 * @property string $description
 * @property ProjectStatus $status
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property int $created_by
 * @property int $updated_by
 * @property int $id
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ContactChannel|null $contactChannel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormQuestion> $formQuestions
 * @property-read int|null $form_questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Idea> $ideas
 * @property-read int|null $ideas_count
 * @property-read \App\Models\SupportPack|null $supportPack
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCompletedProjectElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereContactChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGaranty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereGarantyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereOriginalProjectGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectNotContainedElements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSolvedProblems($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereSupportPackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\WebsiteType|null $websiteType
 * @method static \Database\Factories\RequestQuoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RequestQuote query()
 */
	class RequestQuote extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SupportPackFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupportPack whereUpdatedAt($value)
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
 * @property \App\Enums\OpenAIRole $role
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SystemChatParameterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereFormFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereFormFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SystemChatParameter whereUpdatedAt($value)
 */
	class SystemChatParameter extends \Eloquent {}
}

namespace App\Models{
/**
 * User
 *
 * @property string $email
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestQuote> $requestQuotes
 * @property-read int|null $request_quotes_count
 * @method static \Database\Factories\WebsiteTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WebsiteType query()
 */
	class WebsiteType extends \Eloquent {}
}

