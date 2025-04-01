<?php

declare(strict_types=1);

use App\Models\WebsiteType;
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
        Schema::create('request_quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('company_name')->nullable();
            // website type
            $table->foreignIdFor(WebsiteType::class)->nullable(false);
            $table->json('websites')->nullable();
            $table->boolean('have_website_graphic')->default(false);
            $table->json('functionalities')->nullable();
            $table->boolean('is_multilangual')->default(false);
            $table->json('languages')->nullable();
            $table->boolean('is_ecommerce')->default(false);
            $table->json('ecommerce_functionalities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_quotes');
    }
};
