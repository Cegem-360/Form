<?php

declare(strict_types=1);

use App\Models\FormQuestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_question_visibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FormQuestion::class)->nullable(false);
            $table->boolean('token_visible')->default(true);
            $table->boolean('company_name_visible')->default(true);
            $table->boolean('contact_name_visible')->default(true);
            $table->boolean('contact_email_visible')->default(true);
            $table->boolean('contact_phone_visible')->default(true);
            $table->boolean('logo_visible')->default(true);
            $table->boolean('activities_visible')->default(true);
            $table->boolean('contact_position_visible')->default(true);
            $table->boolean('have_exist_website_visible')->default(true);
            $table->boolean('exist_website_url_visible')->default(true);
            $table->boolean('is_exact_deadline_visible')->default(true);
            $table->boolean('deadline_visible')->default(true);
            $table->boolean('formating_milestone_visible')->default(true);
            $table->boolean('visual_feeling_visible')->default(true);
            $table->boolean('have_exist_design_visible')->default(true);
            $table->boolean('design_files_visible')->default(true);
            $table->boolean('inspire_websites_visible')->default(true);
            $table->boolean('banned_elements_visible')->default(true);
            $table->boolean('primary_color_visible')->default(true);
            $table->boolean('secondary_color_visible')->default(true);
            $table->boolean('additional_colors_visible')->default(true);
            $table->boolean('prefered_font_types_visible')->default(true);
            $table->boolean('own_company_images_visible')->default(true);
            $table->boolean('use_video_or_animation_visible')->default(true);
            $table->boolean('own_company_videos_visible')->default(true);
            $table->boolean('main_pages_visible')->default(true);
            $table->boolean('other_pages_visible')->default(true);
            $table->boolean('have_product_catalog_visible')->default(true);
            $table->boolean('product_catalog_visible')->default(true);
            $table->boolean('tone_of_website_visible')->default(true);
            $table->boolean('other_tone_of_website_visible')->default(true);
            $table->boolean('need_multi_language_visible')->default(true);
            $table->boolean('languages_for_website_visible')->default(true);
            $table->boolean('call_to_actions_visible')->default(true);
            $table->boolean('have_blog_visible')->default(true);
            $table->boolean('exist_blog_count_visible')->default(true);
            $table->boolean('importance_of_seo_visible')->default(true);
            $table->boolean('have_payed_advertising_visible')->default(true);
            $table->boolean('other_expectation_or_request_visible')->default(true);
            $table->boolean('products_csv_file_visible')->default(true);
            $table->boolean('highlighted_categories_visible')->default(true);
            $table->boolean('bruto_netto_visible')->default(true);
            $table->boolean('store_address_visible')->default(true);
            $table->boolean('shipping_address_visible')->default(true);
            $table->boolean('parcel_points_visible')->default(true);
            $table->boolean('have_contracted_accountant_visible')->default(true);
            $table->boolean('contracted_accountants_visible')->default(true);
            $table->boolean('payment_methods_visible')->default(true);
            $table->boolean('have_contracted_online_bank_card_payment_visible')->default(true);
            $table->boolean('online_bank_card_payment_options_visible')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_question_visibilities');
    }
};
