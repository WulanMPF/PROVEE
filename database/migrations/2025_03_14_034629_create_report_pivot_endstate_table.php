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
        Schema::table('report_pivot_endstate', function (Blueprint $table) {
            $table->integer('pi_tot');
            $table->integer('ps_tot');
            $table->integer('cancel_tot');
            $table->integer('fallout_tot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_pivot_endstate');
    }
};
