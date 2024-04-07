<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "absensis";
    protected $primaryKey = "id";
    protected $fillable = ['bulan',
                            'tahun',
                            'pegawai_id',
                            'hadir',
                            'izin',
                            'sakit',
                            'alpha',
                            'terlambat',
                            'selisih',
                            'penjualan'];

    public function pegawai ()
    {
        return $this->belongsto(Pegawai::class);
    }

    
    

}
