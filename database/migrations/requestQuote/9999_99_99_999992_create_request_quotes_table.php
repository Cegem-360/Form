<?php

declare(strict_types=1);

use App\Enums\ClientType;
use App\Models\User;
use App\Models\WebsiteType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Import the new enum

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_quotes', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('quotation_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('client_type', array_column(ClientType::cases(), 'value'))->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->longText('project_description')->nullable();
            // website type
            $table->foreignIdFor(WebsiteType::class)->nullable(false);

            $table->string('website_engine')->nullable();
            $table->json('websites')->nullable();
            $table->boolean('have_website_graphic')->default(false)->nullable();
            $table->boolean('is_multilangual')->default(false)->nullable();
            $table->json('languages')->nullable();
            $table->string('payment_method')->nullable();
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
