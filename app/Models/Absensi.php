<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = "absensis";
    protected $primaryKey = "id";
    protected $fillable = ['bulan',
                            'tahun',
                            'user_id',
                            'hadir',
                            'sakit',
                            'alpha'];

    public function user ()
    {
        return $this->belongsto(User::class);
    }
    

}
