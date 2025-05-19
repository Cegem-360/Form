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
        Schema::create('website_type_prices', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(WebsiteType::class)->nullable(false);
            $table->string('website_engine')->nullable(false);
            $table->string('size')->nullable(false);
            $table->integer('price')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_type_prices');
    }
};
