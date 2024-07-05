<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailAbsenExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $groupedAbsensis;

    public function __construct(Collection $groupedAbsensis)
    {
        $this->groupedAbsensis = $groupedAbsensis;
    }

    public function collection()
    {
        $exportData = collect([]);

        foreach ($this->groupedAbsensis as $pegawaiId => $absensiPegawai) {
            // Add title for each employee
            $firstAbsensi = $absensiPegawai->first();

            $exportData->push([
                'Pegawai ID' => 'ID: ' . $pegawaiId,
                'Nama' => '',
                'Toko' => '',
            ]);
            $exportData->push([
                'Pegawai ID' => 'Nama: ' . $firstAbsensi['nama'],
                'Nama' => '',
                'Toko' => '',
            ]);
            $exportData->push([
                'Pegawai ID' => 'Toko: ' . $firstAbsensi['toko'],
                'Nama' => '',
                'Toko' => '',
            ]);

            // Add an empty row to separate title and table
            $exportData->push(['', '', '']);

            // Add headings
            $exportData->push($this->headings());

            // Add data
            foreach ($absensiPegawai as $tanggal => $absensi) {
                $exportData->push([
                    'Tanggal' => $tanggal,
                    'Jam Masuk' => $absensi['jam_masuk'] ?? null,
                    'Jam Keluar' => $absensi['jam_keluar'] ?? null,
                    'Shift' => $absensi['shift'],
                    'Jam Kerja' => $absensi['jam_kerja'],
                    'Status' => $absensi['status_shift'],
                    'Keterangan' => $absensi['keterangan'] ?? null,
                ]);
            }

            // Add an empty row for separation between employees
            $exportData->push(['', '', '']);
        }

        return $exportData;
    }

    public function headings(): array
    {
        return [
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
        $rowIndex = 1;
        $styles = [];

        foreach ($this->groupedAbsensis as $pegawaiId => $absensiPegawai) {
            // Bold style for ID, Nama, Toko
            $styles["A$rowIndex"] = ['font' => ['bold' => true]];
            $styles["A" . ($rowIndex + 1)] = ['font' => ['bold' => true]];
            $styles["A" . ($rowIndex + 2)] = ['font' => ['bold' => true]];

            $rowIndex += 4; // Skip ID, Nama, Toko rows and empty row

            // Bold style for table headings
            $styles["A$rowIndex:G$rowIndex"] = ['font' => ['bold' => true]];
            $rowIndex++; // Move to the first data row

            // Iterate through the data rows
            foreach ($absensiPegawai as $tanggal => $absensi) {
                $rowIndex++;
            }

            // Skip the empty row for separation
            $rowIndex++;
        }

        // Add border style for all data rows except title rows
        foreach (range(1, $rowIndex) as $row) {
            if (!isset($styles["A$row"]) && !isset($styles["A" . ($row - 1)])) {
                $styles["A$row:G$row"] = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ]
                    ]
                ];
            }
        }

        return $styles;
    }
}
