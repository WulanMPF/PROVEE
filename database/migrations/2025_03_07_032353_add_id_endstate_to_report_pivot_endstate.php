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
            $table->unsignedBigInteger('id_endstate')->index();

            // Foreign Key
            $table->foreign('id_endstate')->references('id_endstate')->on('report_endstate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_orbit', function (Blueprint $table) {
            $table->dropForeign(['id_endstate']);
            $table->dropColumn('id_endstate');
        });
    }
};
