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
            [],
        ];

        // Convert numeric values to ensure they are treated as numbers in Excel
        $formattedData = $this->data->map(function ($item) {
            return [
                $item['nama'] ?? '',
                $item['jumlah_masuk'] ?? 0,
                $item['jumlah_terlambat'] ?? 0,
                $item['jumlah_pulang_cepat'] ?? 0,
                $item['jumlah_tidak_ada_in_out'] ?? 0,
                $item['jumlah_full'] ?? 0,
                $item['jumlah_off'] ?? 0,
                $item['jumlah_setengah_hari'] ?? 0,
                $item['total_jam_kerja'] ?? 0,
                $item['jumlah_sakit'] ?? 0,
                $item['jumlah_cuti'] ?? 0,
                $item['jumlah_ijin'] ?? 0,
                $item['jumlah_alpha'] ?? 0,
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
                $sheet->mergeCells('A1:N1');
                $sheet->mergeCells('A2:N2');
                $sheet->setCellValue('A1', 'Data rekapitulasi Tanggal ' . $this->start_date . ' Sampai Tanggal ' . $this->end_date);
                $sheet->setCellValue('A2', 'Toko: ' . $this->toko);
                $sheet->getStyle('A1:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12, // Ukuran font untuk judul
                    ],
                ]);

                // Styling untuk heading data (baris 4)
                $sheet->getStyle('A4:N4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 8, // Ukuran font untuk header data
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Styling untuk baris data
                $sheet->getStyle('A5:N' . ($this->data->count() + 4))->applyFromArray([
                    'font' => [
                        'size' => 8, // Ukuran font untuk baris data
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Mengatur lebar kolom untuk optimalkan tampilan
                $columnWidths = [
                    'A' => 10, 'B' => 10, 'C' => 10, 'D' => 12, 'E' => 10,
                    'F' => 12, 'G' => 9, 'H' => 9, 'I' => 12, 'J' => 11,
                    'K' => 9, 'L' => 9, 'M' => 9, 'N' => 9,
                ];

                foreach ($columnWidths as $column => $width) {
                    $sheet->getColumnDimension($column)->setWidth($width);
                }

                // Mengatur tinggi baris jika diperlukan
                $sheet->getDefaultRowDimension()->setRowHeight(10);
            },
        ];
    }
}
