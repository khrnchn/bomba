<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('counter_staff', function (Blueprint $table) {
            $table
                ->foreign('staff_id')
                ->references('id')
                ->on('staff')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('counter_id')
                ->references('id')
                ->on('counters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('counter_staff', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['counter_id']);
        });
    }
};
