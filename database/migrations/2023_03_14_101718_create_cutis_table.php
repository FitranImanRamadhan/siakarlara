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
        Schema::create('cutis', function (Blueprint $table) {
            $table->bigIncrements('urut');
            $table->unsignedBigInteger('id'); // Menggunakan unsignedBigInteger tanpa auto increment
            $table->string('nama')->nullable();
            $table->string('date_cuti')->nullable();
            $table->string('end_cuti')->nullable();
            $table->string('jumlah_cuti')->nullable();
            $table->string('toko')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jenis_cuti')->nullable();
            $table->string('alasan_cuti')->nullable();
            $table->string('ambil_tugas')->nullable();
            $table->string('filename')->nullable();
            $table->string('image_data')->nullable();
            $table->string('status')->nullable();
            $table->string('kode')->nullable();
            $table->string('date_acc')->nullable();
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
        Schema::dropIfExists('cutis');
    }
};
