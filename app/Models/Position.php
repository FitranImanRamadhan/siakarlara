<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = "positions";
    protected $primaryKey = "id";
    protected $fillable = ['jabatan','gaji_perhari', 'tunjangan_jabatan', 'uang_makan'];

    public function pegawai ()
    {
        return $this->hasMany(Pegawai::class);
    }
    

}
