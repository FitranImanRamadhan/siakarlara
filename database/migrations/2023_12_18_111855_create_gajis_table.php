<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('tahun');
            $table->string('bulan');
            $table->integer('total_gaji');
            $table->integer('insentif_absen');
            $table->integer('uang_lembur');
            $table->integer('gaji_kotor');
            $table->integer('bpjs_tk');
            $table->integer('bpjs_kes');
            $table->integer('gaji_bersih');
            $table->integer('gaji_diterima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gajis');
    }
};
