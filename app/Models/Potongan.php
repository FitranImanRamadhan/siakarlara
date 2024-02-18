<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class potongan extends Model
{
    use HasFactory;

    protected $table = "potongans";
    protected $primaryKey = "id";
    protected $fillable = ['umr_id','bpjs_tk','bpjs_kes','alpha'];

    public function umr ()
    {
        return $this->belongsTo(Umr::class);
    }
    

}
