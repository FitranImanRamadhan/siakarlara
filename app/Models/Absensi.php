<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model {
    use HasFactory;

    protected $table = 'absensis';
    protected $fillable = ["urut","id", "tanggal", "jam", "kode1", "kode2", "kode3","keterangan"];

}
