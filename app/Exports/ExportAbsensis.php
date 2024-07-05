<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAbsensis implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $absensis = Absensi::select('id', 'tanggal', 'jam', 'kode1', 'kode2', 'kode3', 'keterangan')->get();

        return $absensis;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Tanggal',
            'Jam',
            'Kode1',
            'Kode2',
            'Kode3',
            'Keterangan',
        ];
    }
}
