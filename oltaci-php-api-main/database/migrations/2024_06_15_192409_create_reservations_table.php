<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tour_id');
            $table->double('total_price')->default(0)->nullable();
            $table->enum('currency',['USD','GBP', 'EUR', 'TRY'])->nullable();
            $table->integer('number_of_people');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->boolean('has_been_verified')->default(false);
            $table->boolean('has_been_paid')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tour_id')
                ->references('id')
                ->on('tours')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
