<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GajiExport implements FromCollection, WithHeadings
{
    protected $gajis;

    public function __construct($gajis)
    {
        $this->gajis = $gajis;
    }

    public function collection()
    {
        return $this->gajis->map(function ($gaji) {
            $absensi = Absensi::where('pegawai_id', $gaji->kode)->first();
            $nama_pegawai = $absensi ? $absensi->pegawai->nama : '(blank)';
            $nama_jabatan = $absensi ? $absensi->pegawai->position->jabatan : '(blank)';
            $tunjangan_jabatan = $absensi ? $absensi->pegawai->position->tunjangan_jabatan : '(blank)';
            
            return [
                'ID' => $gaji->id,
                'Nama' => $nama_pegawai,
                'Jabatan' => $nama_jabatan,
                'Bulan' => $gaji->bulan,
                'Tahun' => $gaji->tahun,
                'total_gaji' => $gaji->total_gaji,
                'insentif_absen' => $gaji->insentif_absen,
                'tunjangan_jabatan' => $tunjangan_jabatan,
                'uang_lembur' => $gaji->uang_lembur,
                'gaji_kotor' => $gaji->gaji_kotor,
                'bpjs_tk' => $gaji->bpjs_tk,
                'bpjs_kes' => $gaji->bpjs_kes,
                'gaji_bersih' => $gaji->gaji_bersih,
                'gaji_diterima' => $gaji->gaji_diterima,
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
            'Total Gaji',
            'Insentif Absen',
            'Tunjangan Jabatan',
            'Uang Lembur',
            'Gaji Kotor',
            'Bpjs Tk',
            'Bpjs Kes',
            'Gaji Bersih',
            'Gaji Diterima'
        ];
    }
}
