<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penggajian extends Model {
    use HasFactory;

    protected $table = 'penggajians';
    protected $fillable = ["absensi_id", "tahun", "bulan", "total_gaji", "insentif_absen", "gaji_kotor", "bpjs_tk", "bpjs_kes", "gaji_bersih", "pembulatan", "gaji_diterima"];

    public function absensi() {
		return $this->belongsTo(Absensi::class);
	}
}
