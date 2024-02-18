<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umr extends Model
{
    use HasFactory;

    protected $table = "umrs";
    protected $primaryKey = "id";
    protected $fillable = ['kota','upah_umr'];
    
    public function potongan ()
    {
        return $this->hasMany(Potongan::class);
    }

}
