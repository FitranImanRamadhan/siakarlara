<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gajis';
    protected $fillable = [
        "kode", // Perubahan disini
        "tahun",
        "bulan",
        "total_gaji",
        "insentif_absen",
        "uang_lembur",
        "gaji_kotor",
        "bpjs_tk",
        "bpjs_kes",
        "gaji_bersih",
        "gaji_diterima"
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'kode', 'pegawai_id'); // Perubahan disini
    }
}
