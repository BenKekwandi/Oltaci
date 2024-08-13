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
        Schema::create('boat_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('boat_id')
            ->references('id')
            ->on('boats')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boat_pictures');
    }
};
