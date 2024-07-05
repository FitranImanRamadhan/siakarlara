<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPegawais implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil data pegawai dengan memilih kolom yang dibutuhkan
        $pegawais = Pegawai::select('id', 'nama', 'toko', 'jabatan', 'score')->get();

        // Menggunakan map untuk memastikan nilai score tidak kosong
        $pegawais->map(function ($pegawai) {
            // Jika score kosong, set menjadi 0
            $pegawai->score = $pegawai->score ?: 0;
            return $pegawai;
        });

        return $pegawais;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Toko',
            'Jabatan',
            'Score',
        ];
    }
}
