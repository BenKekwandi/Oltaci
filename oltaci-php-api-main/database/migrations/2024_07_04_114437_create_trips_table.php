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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->unsignedBigInteger('captain_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('departure');
            $table->string('destination');
            $table->enum('status', ['SCHEDULED', 'ONGOING', 'COMPLETED']);
            $table->dateTime('start');
            $table->dateTime('end');

            $table->foreign('boat_id')
                ->references('id')
                ->on('boats')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('captain_id')
                ->references('id')
                ->on('captains')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
