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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('departure_id');
            $table->unsignedBigInteger('destination_id');
            $table->string('description')->nullable();
            $table->integer('duration');
            $table->double('price');
            $table->enum('currency',['USD','GBP', 'EUR', 'TRY'])->nullable();
            $table->enum('type', ['INDIVIDUAL', 'GROUP', 'VIP']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('boat_id')
                ->references('id')
                ->on('boats')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('departure_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('destination_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
