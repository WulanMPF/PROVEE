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
        Schema::table('report_endstate', function (Blueprint $table) {
            // Hapus foreign key constraint dulu
            $table->dropForeign('report_endstate_id_periode_foreign');

            // Lalu hapus kolomnya
            $table->dropColumn('id_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_endstate', function (Blueprint $table) {
            // Tambahkan kembali kolom dan foreign key jika perlu
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->foreign('id_periode')->references('id')->on('periodes')->onDelete('cascade');
        });
    }
};
