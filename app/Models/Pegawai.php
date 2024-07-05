<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = "pegawais";
    protected $primaryKey = "id";
    
    // Menyatakan bahwa kolom 'id' bukan auto-incrementing
    public $incrementing = false;

    // Menyatakan tipe data primary key sebagai 'unsignedBigInteger'
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = ['id','nama', 'toko', 'score', 'jabatan'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan', 'jabatan');
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko', 'toko');
    }
}
