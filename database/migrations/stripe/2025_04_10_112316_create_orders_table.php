<?php

declare(strict_types=1);

use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use App\Models\RequestQuote;
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
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->integer('amount');
            $table->enum('currency', array_column(StripeCurrency::cases(), 'value'));
            $table->enum('status', array_column(TransactionStatus::cases(), 'value'));
            $table->string('customer_email')->nullable();
            $table->string('customer_name')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(RequestQuote::class)->nullable()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
