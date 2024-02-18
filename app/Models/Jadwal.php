<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwals";
    protected $primaryKey = "id";
    protected $fillable = ['user_id',
                            'tgl_masuk',
                            'ket_jadwal'];
    protected $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsto(User::class);
    }

    public function jabatan ()
    {
        return $this->belongsto(Position::class);
    }
    

}
