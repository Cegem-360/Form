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
        Schema::create('request_quote_functionalities', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('price')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->foreignIdFor(WebsiteType::class)->nullable(false);

            $table->boolean('default')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_quote_functionalities');
    }
};
