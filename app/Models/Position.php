<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model {
    use HasFactory;

    protected $table = 'positions';
    protected $fillable = ["jabatan"];

    public function pegawais() {
		return $this->hasMany(Pegawai::class, 'position_id');
	}

}
