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
        Schema::create('report_provi_manja', function (Blueprint $table) {
            $table->id('id_provi_manja');
            $table->unsignedBigInteger('id_periode')->index();
            $table->unsignedBigInteger('id_wilayah')->index();
            $table->unsignedBigInteger('id_sektor')->index();
            $table->integer('manja_expired_h-1')->default(0);
            $table->integer('manja_hi')->default(0);
            $table->integer('saldo_manja_h+1')->default(0);
            $table->integer('saldo_manja_h+2')->default(0);
            $table->integer('saldo_manja_h>2')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_periode')->references('id_periode')->on('periode');
            $table->foreign('id_wilayah')->references('id_wilayah')->on('wilayah');
            $table->foreign('id_sektor')->references('id_sektor')->on('sektor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_provi_manja');
    }
};
