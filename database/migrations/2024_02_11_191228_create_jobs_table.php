<?php

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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->foreignId('company_id')->constrained("companies");
            $table->foreignId('category_id')->constrained("categories");
            $table->foreignId('city_id')->constrained("cities");
            $table->foreignId('seniority_id')->constrained("seniorities");
            $table->boolean('full_time');
            $table->foreignId('workplace_id')->constrained("workplaces");
            $table->integer('salary')->nullable()->index()->default(null);
            $table->text('description');
            $table->text('responsibilities');
            $table->text('requirements');
            $table->text('benefits');
            $table->dateTime('application_deadline');
            $table->string('status')->index()->default(\App\Models\Job::STATUS_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
