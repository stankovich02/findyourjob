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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("first_name",50);
            $table->string("last_name",50);
            $table->string("email",100)->unique();
            $table->string("password",100);
            $table->string("linkedin",100)->nullable()->default(null);
            $table->string("github",100)->nullable()->default(null);
            $table->string("avatar",100)->nullable()->default(null);
            $table->foreignId("role_id")->constrained("roles");
            $table->boolean("is_active")->default(false);
            $table->string("token",20)->nullable()->unique();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
