<?php

namespace App\Http\Controllers;

use App\Models\Ccr;
use App\Models\Ppc;
use App\Models\Rjo;
use App\Models\Customer;
use App\Models\Marketing;
use App\Models\SparePart;
use Illuminate\Http\Request;
use App\Models\PekerjaanSelesai;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        
        if ($role == 'marketing') {
            return $this->marketing();
        }
        elseif ($role == 'ppc') {
            return $this->ppc();
        }
        elseif ($role == 'admin') {
            return $this->admin();
        }
        else{
            return $this->manager();
        }
    }

    public function marketing()
    {
        $total_customer = Customer::count();
        $total_rjo_berjalan = Rjo::where('marketing_id', Auth::user()->marketing->id)->count();
        $total_rjo_selesai = SparePart::where('marketing_id', Auth::user()->marketing->id)->count();
        return view('dashboard.marketing', compact('total_customer','total_rjo_berjalan','total_rjo_selesai'));
    }
    public function ppc()
    {
        $total_rjo_belum = Rjo::doesntHave('ccr')->count();
        $total_ccr_belum = Ccr::doesntHave('pekerjaan_selesai')->count();
        $total_selesai = SparePart::where('ppc_id', Auth::user()->ppc->id)->count();
        return view('dashboard.ppc', compact('total_rjo_belum', 'total_ccr_belum', 'total_selesai'));
    }
    public function admin()
    {

        $total_rjo_belum = Rjo::doesntHave('ccr')->count();
        $total_ccr = Ccr::doesntHave('pekerjaan_selesai')->count();
        $total_selesai = PekerjaanSelesai::count();
        $total_sparepart = SparePart::count();

        return view('dashboard.admin', compact('total_rjo_belum','total_ccr','total_selesai','total_sparepart'));
    }
    public function manager()
    {

        $total_customer = Customer::count();
        $total_marketing = Marketing::count();
        $total_ppc = Ppc::count();
        $total_staff = $total_marketing + $total_ppc;


        $rjo = Rjo::doesntHave('ccr')->latest()->get()->take(4);
        $ccr = Ccr::doesntHave('pekerjaan_selesai')->latest()->get()->take(4);
        $selesai = PekerjaanSelesai::latest()->get()->take(4);
        $kirim = SparePart::latest()->get()->take(4);


        return view('dashboard.manager', compact('total_customer','total_staff','rjo','ccr','selesai','kirim'));
    }

}

