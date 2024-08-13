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
        Schema::table('boats', function (Blueprint $table) {

            $table->unsignedBigInteger('owner_id')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('capacity')->nullable();
            $table->double('engine_power')->nullable();
            $table->integer('year_built')->nullable();
            $table->string('manufacturer')->nullable();

            $table->foreign('owner_id')
                ->references('id')
                ->on('boat_owners')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('manufacturer');
            $table->dropColumn('year_built');
            $table->dropColumn('engine_power');
            $table->dropColumn('capacity');
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('length');
            $table->dropColumn('owner_id');

        });
    }
};
