<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
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
            $table->date('tanggal_gajian');
            $table->integer('absensi_id');
            $table->integer('pegawai_id');
            $table->integer('potongan_id');
            $table->string('tahun');
            $table->string('bulan');
            $table->integer('total_gaji');
            $table->integer('gaji_kotor');
            $table->integer('gaji_bersih');
            $table->integer('pembulatan');
            $table->integer('gaji_diterima');
            $table->rememberToken();
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
}
