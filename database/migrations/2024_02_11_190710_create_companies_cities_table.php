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
        Schema::create('companies_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained("companies");
            $table->foreignId('city_id')->constrained("cities");

            $table->timestamps();

            $table->unique(['company_id', 'city_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_cities');
    }
};
