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
        Schema::create('captains', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('license_number')->unique();
            $table->integer('years_of_experience');
            $table->text('certifications')->nullable();
            $table->text('special_skills')->nullable();
            $table->text('languages_spoken')->nullable();
            $table->text('availability_calendar')->nullable();
            $table->string('preferred_working_hours')->nullable();
            $table->integer('average_rating')->default(3);
            $table->integer('number_of_reviews')->default(0);
            $table->text('customer_feedback')->nullable();
            $table->string('boat_name')->nullable();
            $table->string('boat_type')->nullable();
            $table->integer('boat_capacity')->nullable();
            $table->text('biography')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->text('gallery')->nullable();
            $table->string('introductory_video')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relation');
            $table->string('emergency_contact_phone');
            $table->boolean('availability_status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captains');
    }
};
