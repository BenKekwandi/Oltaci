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
        Schema::create('reservation_additional_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->unsignedBigInteger('additional_service_id')->nullable();
            $table->timestamps();

            $table->foreign('reservation_id')
            ->references('id')
            ->on('reservations')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('additional_service_id')
            ->references('id')
            ->on('additional_services')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_additional_service');
    }
};
