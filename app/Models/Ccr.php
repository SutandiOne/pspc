<?php

namespace App\Models;

use App\Models\Rjo;
use App\Models\PekerjaanSelesai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ccr extends Model
{
    use HasFactory;

    protected $table = 'ccr';

    protected $guarded = []; 

    public function rjo()
    {
        return $this->belongsTo(Rjo::class);
    }

    // belongs one
    public function pekerjaan_selesai()
    {
        return $this->hasOne(PekerjaanSelesai::class);
    }
}
