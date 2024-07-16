<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model {
    use HasFactory;

    protected $table = 'cutis';
    protected $fillable = ["urut", "nama", "date_cuti", "end_cuti", "jumlah_cuti", "toko", "jabatan", "jenis_cuti", "alasan_cuti", "ambil_tugas", "filename", "image_data", "status", "kode", "date_acc"];

}
