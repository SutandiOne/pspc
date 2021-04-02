<?php

namespace App\Models;

use App\Models\Rjo;
use App\Models\SparePart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $guarded = []; 



    public function rjo()
    {
        return $this->hasMany(Rjo::class);
    }

    public function sparepart()
    {
        return $this->hasMany(SparePart::class);
    }

    public function getSparepartCountAttribute()
    {   
        return $this->sparepart->count();
    }


}
