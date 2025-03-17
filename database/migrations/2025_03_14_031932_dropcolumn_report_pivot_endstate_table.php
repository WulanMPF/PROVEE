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
            $table->dropColumn('pi_total');
            $table->dropColumn('ps_total');
            $table->dropColumn('cancel_total');
            $table->dropColumn('fallout_total');
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
