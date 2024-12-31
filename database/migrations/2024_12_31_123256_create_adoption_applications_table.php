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
        Schema::create('adoption_applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_profile_id'); 
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->cascadeOnDelete();

            $table->unsignedBigInteger('pet_id'); 
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnDelete();

            $table->string('contact');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('adopter_description');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_applications');
    }
};
