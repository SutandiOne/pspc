<?php

namespace App\Models;

use App\Models\Ccr;
use App\Models\Ppc;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PekerjaanSelesai extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan_selesai';

    protected $guarded = [];


    public function getDateFinishsAttribute(){
        $date_finish = Carbon::parse($this->date_finish)->isoFormat('dddd, Do MMMM YYYY');
        return $date_finish;
    }


    public function ccr()
    {
        return $this->belongsTo(Ccr::class);
    }
    public function ppc()
    {
        return $this->belongsTo(Ppc::class);
    }
}
