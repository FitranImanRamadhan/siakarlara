<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $absensis;

    public function __construct($absensis)
    {
        $this->absensis = $absensis;
    }

    public function collection()
    {
        return $this->absensis->map(function ($absensi) {
            return [
                'ID' => $absensi->id,
                'Nama' => $absensi->user->name, // Ubah 'nama' dengan nama field yang menyimpan nama user
                'Jabatan' => $absensi->user->position->jabatan,
                'Bulan' => $absensi->bulan,
                'Tahun' => $absensi->tahun,
                'Hadir' => $absensi->hadir,
                'Sakit' => $absensi->sakit,
                'Alpha' => $absensi->alpha,
                 // Ubah 'jabatan' dengan nama relasi ke jabatan
                // Tambahkan kolom lain jika diperlukan
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Jabatan',
            'Bulan',
            'Tahun',
            'Hadir',
            'Sakit',
            'Alpha',
            // Tambahkan kolom lain jika diperlukan
        ];
    }
}

