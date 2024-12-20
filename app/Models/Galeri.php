<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model {
    use HasFactory;

    protected $table = 'galeris';
    protected $fillable = ["kategori_promo", "kode_loker", "foto"];
}
