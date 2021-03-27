<?php

namespace App\Models;

use App\Models\Ccr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Ppc;

class PekerjaanSelesai extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_selesai';

    protected $guarded = [];

    public function ccr()
    {
        return $this->belongsTo(Ccr::class);
    }
    public function ppc()
    {
        return $this->belongsTo(Ppc::class);
    }
}
