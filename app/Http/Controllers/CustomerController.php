<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function list()
    {
        if (request()->ajax()) {
            
            //user
            $customer = Customer::all();

            return datatables()->of($customer)
                ->addColumn('aksi', function($data){

                    $rDel = 'customer.destroy';
                    $rEdit = 'customer.edit';
                    $rShow = null;
                    $rFile = null;

                   
                    return view('layout.com.action', compact('data','rEdit','rDel','rShow','rFile'))->render();

                })
                ->rawColumns(['aksi'])
                ->make(true);

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rAdd = 'customer.create';
        
        return view('app.customer.index', compact('rAdd'));
    }

     //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $customer)
    {  
        
        return view('app.customer.form', compact('title', 'action', 'method', 'customer'));
    }
    //-------------------------------------------------------------------------------------------------------------------------



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('customer.store');
        $method = 'POST';
        $customer = new Customer();

        return $this->form('Tambah Customer ', $action, $method, $customer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $data = request()->validate([
            'nama' => 'required|string|max:120',
            'no_telepon' => 'required|string|max:20',
            'address' => 'required|string|max:190',
        ]);


        Customer::create($data);

        return redirect()->route('customer.index')->with('success', 'Data Customer berhasil dimasukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $action = route('customer.update', $customer->id);
        $method = 'PATCH';

        return $this->form('Ubah Customer', $action, $method, $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = request()->validate([
            'nama' => 'required|string|max:120',
            'no_telepon' => 'required|string|max:20',
            'address' => 'required|string|max:190',
        ]);

        $customer->update($data);
        
        return redirect()->route('customer.index')->with('success', 'Data Customer '.$customer->nama.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        
        $nama = $customer->nama;
        $customer->delete();

        return redirect()->back()->with('success', 'Data Customer '.$nama.' berhasil dihapus');

    }
}
