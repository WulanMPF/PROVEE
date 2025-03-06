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
        Schema::create('report_endstate', function (Blueprint $table) {
            $table->id('id_endstate');
            $table->unsignedBigInteger('id_periode')->index();
            $table->unsignedBigInteger('id_wilayah')->index();
            $table->integer('pi_hi')->default(0);
            $table->integer('ps_hi')->default(0);
            $table->integer('accomp')->default(0);
            $table->float('ps/pi_hi')->default(0);
            $table->integer('pi_tot')->default(0);
            $table->integer('ps_tot')->default(0);
            $table->integer('target_tot')->default(0);
            $table->float('ps/pi_tot')->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_periode')->references('id_periode')->on('periode');
            $table->foreign('id_wilayah')->references('id_wilayah')->on('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_endstate');
    }
};
