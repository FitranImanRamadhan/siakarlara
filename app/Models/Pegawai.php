<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = "pegawais";
    protected $primaryKey = "id";
    protected $fillable = ['nama','position_id', 'jenis_kelamin', 'tanggal_bergabung'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    


    public function absensi  ()
    {
        return $this->hasMany(Absensi::class);
    }

    public function position  ()
    {
        return $this->belongsTo(Position::class);
    }

    
}
