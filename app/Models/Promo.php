<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promo extends Model {
    use HasFactory;

    protected $table = 'promos';
    protected $fillable = ["kode_promo", "nama", "harga_awal", "harga_promo", "kategori", "periode"];

}
