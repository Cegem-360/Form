<?php

declare(strict_types=1);

use App\Enums\FormQuestionStatus;
use App\Models\Domain;
use App\Models\Project;
use App\Models\User;
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
        Schema::create('form_questions', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Domain::class)->nullable();
            $table->foreignIdFor(Project::class)->nullable();

            $table->text('token')->nullable();
            // Common information
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_positsion')->nullable();
            $table->string('logo')->nullable();
            $table->json('activities')->nullable();

            // theme
            $table->boolean('have_exist_website')->default(false);
            $table->string('exist_website_url')->nullable();
            $table->boolean('is_exact_deadline')->default(false);
            $table->date('deadline')->nullable();
            $table->text('formating_milestone')->nullable();
            $table->text('visual_feeling')->nullable();
            $table->text('tone_of_website')->nullable();

            $table->boolean('have_exist_design')->default(false);
            $table->json('design_files')->nullable();

            $table->json('banned_elements')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->json('additional_colors')->nullable();
            $table->json('prefered_font_types')->nullable();

            // Pages
            $table->json('own_company_images')->nullable();
            $table->boolean('use_video_or_animation')->nullable();
            $table->json('own_company_videos')->nullable();
            $table->json('main_pages')->nullable();

            $table->boolean('have_product_catalog')->default(false);
            $table->json('product_catalog')->nullable();
            $table->boolean('need_multi_language')->nullable();
            $table->text('languages_for_website')->nullable();
            $table->text('call_to_actions')->nullable();
            $table->boolean('have_blog')->default(false);
            $table->text('exist_blog_count')->nullable();
            $table->string('importance_of_seo')->nullable();
            $table->boolean('have_payed_advertising')->nullable();
            $table->text('other_expectation_or_request')->nullable();
            // Webshop

            $table->string('products_csv_file')->nullable();
            $table->json('highlighted_categories')->nullable();
            $table->string('bruto_netto')->nullable();
            $table->string('store_address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->json('parcel_points')->nullable();
            $table->boolean('have_contracted_accountant')->default(false);
            $table->json('contracted_accountants')->nullable();
            $table->json('payment_methods')->nullable();
            $table->boolean('have_contracted_online_bank_card_payment')->default(false);
            $table->json('online_bank_card_payment_options')->nullable();
            $table->enum('status', FormQuestionStatus::casesArray())
                ->default(FormQuestionStatus::UNFILLED->value)
                ->comment('Status of the form question, e.g. unfilled, temporarily saved, submitted');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_questions');
    }
};
