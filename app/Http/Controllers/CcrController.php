<?php

namespace App\Http\Controllers;

use App\Models\Ccr;
use App\Models\Rjo;
use App\Models\Marketing;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class CcrController extends Controller
{

    public function list(Request $request)
    {
        if (request()->ajax()) {

            $ccr = Ccr::with(['rjo'])->doesntHave('pekerjaan_selesai')->get();
          

            if($request->filled('from') && $request->filled('to')){
                
                $from = $request->input('from');
                $to = $request->input('to');
                $ccr = Ccr::with(['rjo'])->doesntHave('pekerjaan_selesai')->whereBetween('updated_at', [$from, $to])->get();

            }
            //date_received,part_name,unit_code,customer_nama

            return datatables()->of($ccr)
                ->addColumn('customer', function($data){
                    $customer = $data->rjo->customer_nama();
                    return $customer;
                })
                ->addColumn('unit_code', function($data){
                    $code = $data->rjo->unit_code;
                    return $code;
                })
                ->addColumn('part_name', function($data){
                    $part = $data->rjo->part_name;
                    return $part;
                })
                ->addColumn('date_received', function($data){
                    $date = $data->rjo->date_received;
                    return $date;
                })
                ->addColumn('date_request', function($data){
                    $date = $data->rjo->date_request;
                    return $date;
                })
               
               
                ->addColumn('aksi', function($data){

                    $rDel = 'ccr.destroy';
                    $rEdit = 'ccr.edit';
                    $rFile = 'ccr.file';
                    $rShow = null;
                   
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
        //Route Define
        $rAdd = 'ccr.create';
        
        return view('app.ccr.index', compact('rAdd'));
    }


        //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $ccr)
    {  

        $rjo = Rjo::doesntHave('ccr')->get();
        return view('app.ccr.form', compact('title', 'action', 'method', 'ccr', 'rjo'));
    }
    //-------------------------------------------------------------------------------------------------------------------------


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('ccr.store');
        $method = 'POST';
        $ccr = new Ccr();
        $ccr->rjo = new Rjo();

        return $this->form('Buat Component Condition Report ', $action, $method, $ccr);

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
            'rjo_id' => 'required|exists:rjo,id',
            'file' => 'required|file|max:1024',
        ]);

        $file = $data['file'];
        $name_file = uniqid().'_rjo_no.'.$data['rjo_id'].'.'.$file->getClientOriginalExtension();
        $file = $file->storeAs('public/berkas/ccr/', $name_file);

        $data['file'] = $name_file;

        $ccr = Ccr::create($data);
        
        $route_download = route('ccr.surat', $ccr->id);

        return redirect()->route('ccr.index')->with([
            'success' => 'Data C.C.R berhasil dimasukan dan surat perintah berhasil dibuat',
            'download' => $route_download
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function show(Ccr $ccr)
    {
        return view('app.ccr.view', compact('ccr'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function edit(Ccr $ccr)
    {
        $action = route('ccr.update', $ccr->id);
        $method = 'PATCH';

        return $this->form('Ubah Component Condition Report', $action, $method, $ccr);
    }
    /**
     * Download file the specified resource.
     *
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function file(Ccr $ccr)
    {
        try {
    		  
    		return response()->download(Storage_path('app/public/berkas/ccr/'.$ccr->file));

    	} catch (\Exception $e) {

    		return abort('404');
    	}
    }
    /**
     * Make surat for specified resource.
     *
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function surat(Ccr $ccr)
    {
        
        $surat_ccr = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/surat/ccr.docx'));

        $date_received = Carbon::parse($ccr->rjo->date_received)->isoFormat('dddd, Do MMMM YYYY');
        $date_request = Carbon::parse($ccr->rjo->date_request)->isoFormat('dddd, Do MMMM YYYY');

        $surat_ccr->setValues([
            'ccr_id' => $ccr->id,
            'tahun' => date('Y'),
            'customer_name' => $ccr->rjo->customer->nama,
            'date_received' => $date_received,
            'date_request' => $date_request,
            'unit_model' => $ccr->rjo->unit_code.'-'.$ccr->rjo->part_name,
            'job_desc' => $ccr->rjo->job_desc,
            
        ]);

        $name_surat = 'Surat Perintah Kerja CCR no.'.$ccr->id.'.docx';

        $surat_ccr->saveAs($name_surat);

        return response()->download(public_path($name_surat))->deleteFileAfterSend(true);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ccr $ccr)
    {

        $data = request()->validate([
            'rjo_id' => 'required|exists:rjo,id',
            'file' => 'sometimes|file|max:1024',
        ]);

        if (request()->file('file')) {
            
            //berkas lama
            $exists = Storage::exists('public/berkas/ccr/'.$ccr->file);
            if ($exists) {
                Storage::delete('public/berkas/ccr/'.$ccr->file);
            }

            //berkas baru
            $file = $data['file'];
            $name_file = uniqid().'_rjo_no.'.$data['rjo_id'].'.'.$file->getClientOriginalExtension();
            $file = $file->storeAs('public/berkas/ccr/', $name_file);

            $data['file'] = $name_file;

        }else{
            $data['file'] = $ccr->file;
        }

        $ccr->update($data);

        $route_download = route('ccr.surat', $ccr->id);

        return redirect()->route('ccr.index')->with([
            'success' => 'Data C.C.R berhasil diubah dan surat perintah berhasil dibuat',
            'download' => $route_download
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ccr  $ccr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ccr $ccr)
    {

        $exists = Storage::exists('public/berkas/ccr/'.$ccr->file);
        if ($exists) {
            Storage::delete('public/berkas/ccr/'.$ccr->file);
        }

        $ccr->delete();

        return redirect()->back()->with('success', 'Data C.C.R berhasil dihapus');
    }

    public function select(Request $request)
    {
     
        if (request()->ajax()) {

            if ($request->filled('id')) {
                
                $id = $request->input('id');

                $ccr = Ccr::find($id);
                
                $rjo = Rjo::with('customer', 'marketing')->find($ccr->rjo->id);

                $marketing = Marketing::find($rjo->marketing->id);

                $rjo['marketing_email'] = $marketing->user->email;
                $rjo['ccr_id'] = $ccr->id;

                return response()->json($rjo);
            }

            
        }
    }
}
