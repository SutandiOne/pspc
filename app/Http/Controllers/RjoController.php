<?php

namespace App\Http\Controllers;

use App\Models\Rjo;
use App\Models\Customer;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RjoController extends Controller
{

    public function list(Request $request)
    {
        if (request()->ajax()) {

            $rjo = Rjo::with(['customer','marketing'])->doesntHave('ccr')->get();

            

            if($request->filled('from') && $request->filled('to')){
                
                $from = $request->input('from');
                $to = $request->input('to');
                $rjo = Rjo::with(['customer','marketing'])->doesntHave('ccr')->whereBetween('date_received', [$from, $to])->get();


            }
            

            return datatables()->of($rjo)
                ->addColumn('customer', function($data){
                    $customer = $data->customer->nama;
                    return $customer;
                })
                ->addColumn('marketing', function($data){
                    $marketing = $data->marketing->nama;
                    return $marketing;
                })
                ->addColumn('aksi', function($data){

                    $rDel = 'rjo.destroy';
                    $rEdit = 'rjo.edit';
                    $rShow = null;
                    $rFile = null;
                   
                    return view('layout.com.action', compact('data','rEdit','rDel','rShow','rFile'))->render();

                })
                ->rawColumns(['aksi'])
                ->make(true);

        }
    }
    public function lists(Request $request)
    {
        if (request()->ajax()) {

    
            $rjo = Rjo::with(['customer','marketing'])->doesntHave('ccr')->get();


            if($request->filled('from') && $request->filled('to')){
                
                $from = $request->input('from');
                $to = $request->input('to');
                $rjo = Rjo::with(['customer','marketing'])->doesntHave('ccr')->whereBetween('date_received', [$from, $to])->get();

            } 

            return datatables()->of($rjo)
                ->addColumn('customer', function($data){
                    $customer = $data->customer->nama;
                    return $customer;
                })
                ->addColumn('marketing', function($data){
                    $marketing = $data->marketing->nama;
                    return $marketing;
                })
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
        //Route Define
        $rAdd = 'rjo.create';
        
        return view('app.rjo.index', compact('rAdd'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function browse()
    {
        return view('app.rjo.browse');
    }



     //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $rjo)
    {  

        $customer = Customer::all();
        return view('app.rjo.form', compact('title', 'action', 'method', 'rjo', 'customer'));
    }
    //-------------------------------------------------------------------------------------------------------------------------


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('rjo.store');
        $method = 'POST';
        $rjo = new Rjo();
        $rjo->customer = new Customer();

        return $this->form('Buat R.J.O ', $action, $method, $rjo);
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
            'customer_id' => 'required|exists:customer,id',
            'unit_code' => 'required|string',  
            'part_name' => 'required|string',
            'problem' => 'required',
            'job_desc' => 'required',
            'date_received' => 'required|date',
            'date_request' => 'required|date',
        ]);

        $data['marketing_id'] = Auth::user()->marketing->id;

        Rjo::create($data);

        return redirect()->route('rjo.index')->with('success', 'Data R.J.O berhasil dimasukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rjo  $rjo
     * @return \Illuminate\Http\Response
     */
    public function show(Rjo $rjo)
    {
        return view('app.rjo.view', compact('rjo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rjo  $rjo
     * @return \Illuminate\Http\Response
     */
    public function edit(Rjo $rjo)
    {
        $action = route('rjo.update', $rjo->id);
        $method = 'PATCH';

        return $this->form('Ubah Data R.J.O', $action, $method, $rjo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rjo  $rjo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rjo $rjo)
    {
        $data = request()->validate([
            'customer_id' => 'required|exists:customer,id',
            'unit_code' => 'required|integer',  
            'part_name' => 'required|string',
            'problem' => 'required|string',
            'job_desc' => 'required|string',
            'date_received' => 'required|date',
            'date_request' => 'required|date',
        ]);

        $data['marketing_id'] = Auth::user()->marketing->id;

        $rjo->update($data);

        return redirect()->route('rjo.index')->with('success', 'Data R.J.O berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rjo  $rjo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rjo $rjo)
    {
        $rjo->delete();
        return redirect()->back()->with('success', 'Data R.J.O berhasil dihapus');

    }


    public function select(Request $request)
    {

     
        if (request()->ajax()) {

            if ($request->filled('id')) {
                $id = $request->input('id');
                
                $rjo = Rjo::with('customer', 'marketing')->find($id);

                $marketing = Marketing::find($rjo->marketing->id);

                $rjo['marketing_email'] = $marketing->user->email;

                return response()->json($rjo);
            }

            
        }
    }
}
