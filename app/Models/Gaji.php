<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model {
    use HasFactory;

    protected $table = 'gajis';
    protected $fillable = ["tanggal_gajian", "absensi_id", "pegawai_id","potongan_id", "tahun", "bulan", "total_gaji", "gaji_kotor", "gaji_bersih", "pembulatan", "gaji_diterima", "remember_token"];

    protected $casts = [
		'tanggal_gajian' => 'datetime'
	];

    public function absensi() {
		return $this->belongsTo(Absensi::class);
	}

public function pegawai() {
		return $this->belongsTo(Pegawai::class);
	}

	public function potongan() {
		return $this->belongsTo(potongan::class);
	}
}
