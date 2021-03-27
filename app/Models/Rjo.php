<?php

namespace App\Models;

use App\Models\Ccr;
use App\Models\Customer;
use App\Models\Marketing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rjo extends Model
{
    use HasFactory;

    protected $table = 'rjo';

    protected $guarded = [];


    // belongs one
    public function marketing()
    {   
        return $this->belongsTo(Marketing::class); 
    }
    public function customer()
    {   
        return $this->belongsTo(Customer::class); 
    }

    public function customer_nama()
    {
       return $this->customer->nama;
    }

    public function ccr()
    {
        return $this->hasOne(Ccr::class);
    }
}
