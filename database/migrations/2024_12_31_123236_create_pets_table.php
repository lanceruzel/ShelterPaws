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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_profile_id');
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->cascadeOnDelete();

            $table->string('name');
            $table->enum('type', ['dog', 'cat'])->default('dog');
            $table->string('breed');
            $table->string('age');
            $table->string('health_status');
            $table->string('description');
            $table->string('status')->default('available');
            $table->json('images');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
