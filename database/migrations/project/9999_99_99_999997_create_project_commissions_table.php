<?php

declare(strict_types=1);

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
        Schema::create('project_commissions', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Project::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->integer('commission_amount')->nullable();
            $table->float('commission_percent')->nullable();
            $table->integer(column: 'commission_paid_amount', autoIncrement: false, unsigned: true)->nullable()->default(0);
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
