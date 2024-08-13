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
        Schema::create('boat_fueling', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->double('cost');
            $table->enum('currency',['USD','GBP', 'EUR', 'TRY'])->nullable();
            $table->double('quantity');
            $table->dateTime('fueling_datetime'); 

            $table->foreign('boat_id')
                ->references('id')
                ->on('boats')
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
        Schema::dropIfExists('boat_fueling');
    }
};
