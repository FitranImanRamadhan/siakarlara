<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;

class AbsensisImport implements ToModel
{
    public function model(array $row)
    {
        return new Absensi([
            'id'      => $row[0], // Kolom pertama di file Excel
            'tanggal' => $row[1], // Kolom kedua di file Excel
            'jam'     => $row[2], // Kolom ketiga di file Excel
            'kode1'   => $row[3], // Kolom keempat di file Excel
            'kode2'   => $row[4], // Kolom kelima di file Excel
            'kode3'   => $row[5], // Kolom keenam di file Excel
            'keterangan'   => $row[6],
        ]);
    }
}
