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
        Schema::create('boosted_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->dateTime('boosted_at')->default(now());
            $table->dateTime('boosted_until');
            $table->unsignedInteger('boosted_days');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->index('boosted_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boosted_jobs');
    }
};
