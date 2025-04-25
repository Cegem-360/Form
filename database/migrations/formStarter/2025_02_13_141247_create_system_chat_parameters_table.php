<?php

declare(strict_types=1);

use App\Enums\OpenAIRole;
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
        Schema::create('system_chat_parameters', function (Blueprint $table): void {
            $table->id();
            $table->string('form_field_name')->nullable(false);
            $table->integer('form_field_id')->nullable(false);
            $table->enum('role', array_map(fn ($role) => $role->value, OpenAIRole::cases()))->default(OpenAIRole::SYSTEM->value);
            $table->longText('content')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_chat_parameters');
    }
};
