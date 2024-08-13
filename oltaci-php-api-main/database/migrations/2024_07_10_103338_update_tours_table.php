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
        Schema::table('captains', function (Blueprint $table) {
            
            $table->unsignedBigInteger('captain_id')->nullable()->before('created_at');

            $table->foreign('captain_id')
                ->references('id')
                ->on('captains')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('captains', function (Blueprint $table) {
            $table->dropForeign('captain_id');
            $table->dropColumn('captain_id');
        });
    }
};
