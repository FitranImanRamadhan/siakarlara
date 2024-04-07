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
            $table->string('bulan');
            $table->string('tahun');
            $table->unsignedBigInteger('pegawai_id');
            $table->integer('total_gaji');
            $table->integer('tnj_jabatan');
            $table->integer('tnj_makan');
            $table->integer('lembur');
            $table->integer('insetif_absen');
            $table->integer('insentif_sales');
            $table->integer('gaji_kotor');
            $table->integer('potongan_id');
            $table->integer('kasbon');
            $table->integer('barang');
            $table->integer('gaji_bersih');
            $table->integer('pembulatan');
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
