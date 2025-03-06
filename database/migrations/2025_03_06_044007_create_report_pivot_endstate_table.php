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
        Schema::create('report_pivot_endstate', function (Blueprint $table) {
            $table->id('id_pivot_endstate');
            $table->unsignedBigInteger('id_periode')->index();
            $table->unsignedBigInteger('id_wilayah')->index();
            $table->unsignedBigInteger('id_sektor')->index();
            $table->integer('pi_total')->default(0);
            $table->integer('ps_total')->default(0);
            $table->integer('cancel_total')->default(0);
            $table->integer('fallout_total')->default(0);
            $table->float('ps/pi_total')->default(0);
            $table->float('cancel/pi_total')->default(0);
            $table->float('fallout/pi_total')->default(0);
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
        Schema::dropIfExists('report_pivot_endstate');
    }
};
