<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenggajianExport implements FromCollection, WithHeadings
{
    protected $penggajians;

    public function __construct($penggajians)
    {
        $this->penggajians = $penggajians;
    }

    public function collection()
    {
        return $this->penggajians->map(function ($penggajian) {
            return [
                'ID' => $penggajian->id,
                'Nama' => $penggajian->absensi->pegawai->nama, // Ubah 'nama' dengan nama field yang menyimpan nama pegawai
                'Jabatan' => $penggajian->absensi->pegawai->position->jabatan,
                'Bulan' => $penggajian->bulan,
                'Tahun' => $penggajian->tahun,
                'total_gaji' => $penggajian->total_gaji,
                'insentif_absen' => $penggajian->insentif_absen,
                'tunjangan_jabatan' => $penggajian->absensi->pegawai->position->tunjangan_jabatan,
                'uang_lembur' => $penggajian->uang_lembur,
                'gaji_kotor' => $penggajian->gaji_kotor,
                'bpjs_tk' => $penggajian->bpjs_tk,
                'bpjs_kes' => $penggajian->bpjs_kes,
                'gaji_bersih' => $penggajian->gaji_bersih,
                'gaji_diterima' => $penggajian->gaji_diterima,
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
            'total_gaji',
            'insentif_absen',
            'tunjangan_jabatan',
            'uang_lembur',
            'gaji_kotor',
            'bpjs_tk',
            'bpjs_kes',
            'gaji_bersih',
            'gaji_diterima'

            // Tambahkan kolom lain jika diperlukan
        ];
    }
}

