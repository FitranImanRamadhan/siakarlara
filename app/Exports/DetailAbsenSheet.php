<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailAbsenSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $pegawaiId;
    protected $absensiPegawai;

    public function __construct($pegawaiId, $absensiPegawai)
    {
        $this->pegawaiId = $pegawaiId;
        $this->absensiPegawai = $absensiPegawai;
    }

    public function collection()
    {
        $exportData = collect([]);

        foreach ($this->absensiPegawai as $tanggal => $absensi) {
            $exportData->push([
                'Pegawai ID' => $this->pegawaiId,
                'Nama' => $absensi['nama'],
                'Toko' => $absensi['toko'],
                'Tanggal' => $tanggal,
                'Jam Masuk' => $absensi['jam_masuk'] ?? null,
                'Jam Keluar' => $absensi['jam_keluar'] ?? null,
                'Shift' => $absensi['shift'],
                'Jam Kerja' => $absensi['jam_kerja'],
                'Status' => $absensi['status_shift'],
                'Keterangan' => $absensi['keterangan'] ?? null,
            ]);
        }

        return $exportData;
    }

    public function title(): string
    {
        return 'Pegawai ' . $this->pegawaiId;
    }

    public function headings(): array
    {
        return [
            'Pegawai ID',
            'Nama',
            'Toko',
            'Tanggal',
            'Jam Masuk',
            'Jam Keluar',
            'Shift',
            'Jam Kerja',
            'Status',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Style baris 1 (heading)
            'A1:J1' => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['argb' => '000000']]]], // Style border untuk heading
            'A2:J' . ($this->collection()->count() + 1) => ['borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['argb' => '000000']]]], // Style border untuk seluruh data
        ];
    }
}
