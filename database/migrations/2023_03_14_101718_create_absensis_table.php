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
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('urut'); // Menggunakan bigIncrements untuk auto increment dan primary key
            $table->unsignedBigInteger('id'); // Kolom id tanpa primary key atau unique constraint
            $table->string('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->integer('kode1')->nullable();
            $table->integer('kode2')->nullable();
            $table->integer('kode3')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('absensis');
    }
};
