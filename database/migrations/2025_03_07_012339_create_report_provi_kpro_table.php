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
        Schema::create('report_provi_kpro', function (Blueprint $table) {
            $table->id('id_provi_kpro');
            $table->unsignedBigInteger('id_periode')->index();
            $table->unsignedBigInteger('id_wilayah')->index();
            $table->unsignedBigInteger('id_endstate')->index();
            $table->integer('target_per_hari')->default(0);
            $table->integer('deviasi')->default(0);
            $table->integer('perhitungan_hari')->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_periode')->references('id_periode')->on('periode');
            $table->foreign('id_wilayah')->references('id_wilayah')->on('wilayah');
            $table->foreign('id_endstate')->references('id_endstate')->on('report_endstate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_provi_kpro');
    }
};
