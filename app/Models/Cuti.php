<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cutis';

    // Menentukan kolom yang di-cast
    protected $casts = [
        'urut' => 'integer', // atau 'bigint' jika menggunakan BigInteger
        // Tambahkan cast lain jika diperlukan
    ];

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id',
        'nama',
        'date_cuti',
        'end_cuti',
        'jumlah_cuti',
        'toko',
        'jabatan',
        'jenis_cuti',
        'alasan_cuti',
        'ambil_tugas',
        'filename',
        'image_data',
        'status',
        'kode',
        'date_acc',
    ];
}


