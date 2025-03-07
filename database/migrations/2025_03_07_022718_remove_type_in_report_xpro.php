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
        Schema::table('report_xpro', function (Blueprint $table) {
            $table->dropColumn('ps/re_hi');
            $table->dropColumn('ps/pi_hi');
            $table->dropColumn('ps/re_tot');
            $table->dropColumn('ps/pi_tot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_xpro', function (Blueprint $table) {
            $table->float('ps/re_hi')->default(0);
            $table->float('ps/pi_hi')->default(0);
            $table->float('ps/re_tot')->default(0);
            $table->float('ps/pi_tot')->default(0);
        });
    }
};
