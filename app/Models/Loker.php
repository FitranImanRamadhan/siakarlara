<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loker extends Model {
    use HasFactory;

    protected $table = 'lokers';
    protected $fillable = ["kode_loker", "nama"];

}
