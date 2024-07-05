<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaisImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pegawai([
            'id' => $row['id'],
            'nama' => $row['nama'],
            'jabatan' => $row['jabatan'],
            'toko' => $row['toko'],
            'score' => $row['score'],
        ]);
    }
}

