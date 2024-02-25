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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('logo', 100)->nullable()->default(null);
            $table->string('website', 100)->nullable()->default(null);
            $table->string('phone', 20)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
