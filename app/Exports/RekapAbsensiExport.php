<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;

class RekapAbsensiExport implements FromCollection, WithHeadings, WithEvents
{
    protected $data;
    protected $start_date;
    protected $end_date;
    protected $toko;

    public function __construct(array $data, $start_date, $end_date, $toko)
    {
        $this->data = collect($data);
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->toko = $toko;
    }

    public function collection()
    {
        // Add header with date range and store information
        $header = [
            ['Data rekapitulasi Tanggal ' . $this->start_date . ' Sampai Tanggal ' . $this->end_date],
            ['Toko: ' . $this->toko],
            $this->headings(), // Include headings here
        ];

        // Convert numeric values to ensure they are treated as numbers in Excel
        $formattedData = $this->data->map(function ($item) {
            return [
                'Nama' => $item['nama'] ?? '',
                'Jumlah Masuk' => $item['jumlah_masuk'] ?? 0,
                'Jumlah Terlambat' => $item['jumlah_terlambat'] ?? 0,
                'Jumlah Pulang Cepat' => $item['jumlah_pulang_cepat'] ?? 0,
                'Tidak Ada IN/OUT' => $item['jumlah_tidak_ada_in_out'] ?? 0,
                'Jumlah Full' => $item['jumlah_full'] ?? 0,
                'Jumlah Off' => $item['jumlah_off'] ?? 0,
                'Jumlah Setengah Hari' => $item['jumlah_setengah_hari'] ?? 0,
                'Total Jam Kerja' => $item['total_jam_kerja'] ?? 0,
                'Jumlah Sakit' => $item['jumlah_sakit'] ?? 0,
                'Jumlah Cuti' => $item['jumlah_cuti'] ?? 0,
                'Jumlah Ijin' => $item['jumlah_ijin'] ?? 0,
                'Jumlah Alpha' => $item['jumlah_alpha'] ?? 0,
            ];
        });

        return collect($header)->merge($formattedData);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jumlah Masuk',
            'Jumlah Terlambat',
            'Jumlah Pulang Cepat',
            'Tidak Ada IN/OUT',
            'Jumlah Full',
            'Jumlah Off',
            'Jumlah Setengah Hari',
            'Total Jam Kerja',
            'Jumlah Sakit',
            'Jumlah Cuti',
            'Jumlah Ijin',
            'Jumlah Alpha',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Styling untuk judul
                $sheet->mergeCells('A1:M1');
                $sheet->mergeCells('A2:M2');
                $sheet->setCellValue('A1', 'Data rekapitulasi Tanggal ' . $this->start_date . ' Sampai Tanggal ' . $this->end_date);
                $sheet->setCellValue('A2', 'Toko: ' . $this->toko);
                $sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12, // Ukuran font untuk judul
                    ],
                ]);

                // Styling untuk heading data (baris 4)
                $sheet->getStyle('A4:M4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 10, // Ukuran font untuk header data
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Styling untuk baris data
                $sheet->getStyle('A5:M' . ($this->data->count() + 4))->applyFromArray([
                    'font' => [
                        'size' => 10, // Ukuran font untuk baris data
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Mengatur lebar kolom untuk optimalkan tampilan
                $columnWidths = [
                    'A' => 20, 'B' => 15, 'C' => 15, 'D' => 18, 'E' => 15,
                    'F' => 18, 'G' => 12, 'H' => 12, 'I' => 18, 'J' => 18,
                    'K' => 12, 'L' => 12, 'M' => 12,
                ];

                foreach ($columnWidths as $column => $width) {
                    $sheet->getColumnDimension($column)->setWidth($width);
                }

                // Mengatur tinggi baris jika diperlukan
                $sheet->getDefaultRowDimension()->setRowHeight(15);
            },
        ];
    }
}
