<?php

declare(strict_types=1);

use App\Enums\ProjectStatus;
use App\Models\ContactChannel;
use App\Models\RequestQuote;
use App\Models\SupportPack;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(RequestQuote::class)->nullable();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ProjectStatus::getKeys())->default(ProjectStatus::INACTIVE);
            $table->longText('project_goal')->nullable();
            $table->json('original_project_goals')->nullable();
            $table->json('completed_project_elements')->nullable();
            $table->json('project_not_contained_elements')->nullable();
            $table->json('completed_elements')->nullable();
            $table->json('solved_problems')->nullable();
            $table->integer('garanty')->nullable();
            $table->date('garanty_end_date')->virtualAs('DATE_ADD(start_date, INTERVAL garanty DAY)')->nullable();

            $table->foreignIdFor(User::class, 'contact')->nullable();
            $table->foreignIdFor(SupportPack::class)->nullable();
            $table->foreignIdFor(ContactChannel::class)->nullable();

            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
