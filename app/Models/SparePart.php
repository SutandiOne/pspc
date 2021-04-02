<?php

namespace App\Models;

use App\Models\Ppc;
use App\Models\Customer;
use App\Models\Marketing;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SparePart extends Model
{
    use HasFactory;

    protected $table = 'spare_part';
    protected $guarded = [];
    
    public $incrementing = false;
    
    protected $keyType = 'string';


    public function getRjoAttribute()
    {   
        $id = explode('-', $this->id);
        return $id[0];
    }
    public function getCcrAttribute()
    {   
        $id = explode('-', $this->id);
        return $id[1];
    }


    public function getDateRequestsAttribute()
    {   
        $date_request = Carbon::parse($this->date_request)->isoFormat('dddd, Do MMMM YYYY');
        return $date_request;
    }
    public function getDateReceivedsAttribute()
    {   
        $date_received = Carbon::parse($this->date_received)->isoFormat('dddd, Do MMMM YYYY');
        return $date_received;
    }
    public function getDateFinishsAttribute(){
        $date_finish = Carbon::parse($this->date_finish)->isoFormat('dddd, Do MMMM YYYY');
        return $date_finish;
    }


    public function customer()
    {   
        return $this->belongsTo(Customer::class); 
    }
    public function ppc()
    {   
        return $this->belongsTo(Ppc::class); 
    }
    public function marketing()
    {   
        return $this->belongsTo(Marketing::class); 
    }

    
}
