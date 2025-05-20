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
            // Hapus foreign key constraint dulu
            $table->dropForeign('report_pivot_endstate_id_endstate_foreign');

            // Lalu hapus kolomnya
            $table->dropColumn('id_endstate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_pivot_endstate', function (Blueprint $table) {
            // Tambahkan kembali kolom dan foreign key jika perlu
            $table->unsignedBigInteger('id_endstate')->nullable();
            $table->foreign('id_endstate')->references('id')->on('endstates')->onDelete('cascade');
        });
    }
};
