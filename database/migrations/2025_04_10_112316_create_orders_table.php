<?php

declare(strict_types=1);

use App\Enums\StripeCurrency;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_order_id')->unique();
            $table->integer('amount');
            $table->enum('currency', array_column(StripeCurrency::cases(), 'value'));
            $table->string('status');
            $table->string('customer_email')->nullable();
            $table->string('customer_name')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
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
