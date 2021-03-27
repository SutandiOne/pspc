<?php

namespace App\Models;

use App\Models\Rjo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marketing extends Model
{
    use HasFactory;

    protected $table = 'marketing';


    protected $guarded = [];

    // one
    public function user()
    {   
        return $this->belongsTo(User::class); 
    }

    public function rjo()
    {
        return $this->hasMany(Rjo::class);
    }

    public function sparepart()
    {
        return $this->hasMany(SparePart::class);
    }

}
