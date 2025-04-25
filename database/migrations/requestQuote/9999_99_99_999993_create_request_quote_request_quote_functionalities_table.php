<?php

declare(strict_types=1);

use App\Models\RequestQuote;
use App\Models\RequestQuoteFunctionality;
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
        Schema::create('request_quote_request_quote_functionality', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(RequestQuote::class);
            $table->foreignIdFor(RequestQuoteFunctionality::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_quote_request_quote_functionality');
    }
};
