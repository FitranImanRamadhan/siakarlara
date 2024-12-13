<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class AbsensisImport implements ToModel
{
    public function model(array $row)
    {
        // Cek apakah kolom tanggal valid dan ubah formatnya jika perlu
        $tanggal = is_numeric($row[1]) 
            ? Carbon::instance(Date::excelToDateTimeObject($row[1]))->format('Y-m-d') 
            : Carbon::createFromFormat('d/m/Y', $row[1])->format('Y-m-d');

        return new Absensi([
            'id'          => $row[0], // Kolom pertama di file Excel
            'tanggal'     => $tanggal, // Kolom kedua di file Excel, sudah diformat
            'jam'         => $row[2], // Kolom ketiga di file Excel
            'kode1'       => $row[3], // Kolom keempat di file Excel
            'kode2'       => $row[4], // Kolom kelima di file Excel
            'kode3'       => $row[5], // Kolom keenam di file Excel
            'keterangan'  => $row[6], // Kolom ketujuh di file Excel
        ]);
    }
}
