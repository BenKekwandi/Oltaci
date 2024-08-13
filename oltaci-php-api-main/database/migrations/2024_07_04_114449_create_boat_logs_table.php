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
        Schema::create('boat_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->string('details');
            $table->datetime('log_datetime');

            $table->foreign('boat_id')
                ->references('id')
                ->on('boats')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('trip_id')
                ->references('id')
                ->on('trips')
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
        Schema::dropIfExists('boat_logs');
    }
};
