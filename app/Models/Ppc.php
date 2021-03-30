<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\PekerjaanSelesai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ppc extends Model
{
    use HasFactory;

    protected $table = 'ppc';

    protected $guarded = [];

    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
    public function getGenderAttribute($value)
    {
        return $value == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function user()
    {   
        return $this->belongsTo(User::class); 
    }

    public function pekerjaan_selesai()
    {
        return $this->hasMany(PekerjaanSelesai::class);
    }

    public function sparepart()
    {
        return $this->hasMany(SparePart::class);
    }
}
