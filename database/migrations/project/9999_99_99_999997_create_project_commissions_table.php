<?php

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_commissions', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Project::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->integer('commission_amount')->nullable();
            $table->integer('commission_percent')->nullable();
            $table->integer('commission_paid_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_commissions');
    }
};
