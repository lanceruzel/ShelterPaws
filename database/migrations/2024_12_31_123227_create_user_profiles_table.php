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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            // Common columns
            $table->string('contact');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
        
            // Columns specific to user role
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
        
            // Columns specific to shelter role
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('cover_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
