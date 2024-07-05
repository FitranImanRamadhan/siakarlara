<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Toko extends Model {
    use HasFactory;

    protected $table = 'tokos';
    protected $fillable = ["toko"];

    public function pegawais() {
		return $this->hasMany(Pegawai::class, 'tokos_id');
	}

}
