<?php

namespace App\Http\Livewire\Component;

use App\Models\User;
use Livewire\Component;
use App\Models\SparePart;
use Illuminate\Support\Carbon;

class Staff extends Component
{

    public $staff = [];
    public $staff_id;
    public $staf;
    public $staf_bulan;
    public $staf_tahun;
    public $staf_total;
    
    public function mount($staff)
    {
        $this->staff = $staff;
    }

    public function updatedStaffId($value)
    {
        sleep(2);
        $this->staf = $value ? User::find($value) : new User() ;
        $this->staf_bulan = SparePart::where($this->staf->role.'_id', $this->staf[$this->staf->role]->id)->whereMonth('created_at', Carbon::now()->month)->count();
        $this->staf_tahun = SparePart::where($this->staf->role.'_id', $this->staf[$this->staf->role]->id)->whereYear('created_at', Carbon::now()->year)->count();
        $this->staf_total = SparePart::where($this->staf->role.'_id', $this->staf[$this->staf->role]->id)->count();

    }

    public function render()
    {

        return view('livewire.component.staff');
    }
}
