<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class StatistikController extends Controller
{

    public function staff()
    {

        $staff = User::with('marketing','ppc')->whereIn('role', ['marketing','ppc'])->get();

        return view('statistik.staff', compact('staff'));
    }
    
    public function customer()
    {

        $customer = Customer::withCount('sparepart')->orderBy('sparepart_count', 'desc')->get()->take(5);

        // dd($customer);

        return view('statistik.customer', compact('customer'));
    }
}
