<?php

namespace App\Http\Controllers;

use App\Models\Rjo;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PekerjaanSelesai;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class SparePartController extends Controller
{

    public function list(Request $request)
    {
        if (request()->ajax()) {

            $sparePart = SparePart::with(['marketing', 'ppc', 'customer'])->get();

            if($request->filled('from') && $request->filled('to')){
                
                $from = $request->input('from');
                $to = $request->input('to');
                $sparePart = SparePart::with(['marketing', 'ppc', 'customer'])->whereBetween('date_finish', [$from, $to])->get();

            }
            //

            return datatables()->of($sparePart)
                
                ->addColumn('customer_name', function($data){
                    $date = $data->customer->nama;
                    return $date;
                })
               
               
                ->addColumn('aksi', function($data){

                    $rDel = 'sparepart.destroy';
                    $rEdit = null;
                    $rShow = 'sparepart.show';
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
        //Route Define
        $rAdd = 'sparepart.create';
        
        return view('app.sparepart.index', compact('rAdd'));
    }

      //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $sparepart)
    {  

        $selesai = PekerjaanSelesai::all();
        return view('app.sparepart.form', compact('title', 'action', 'method', 'sparepart', 'selesai'));
    }
    //-------------------------------------------------------------------------------------------------------------------------


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('sparepart.store');
        $method = 'POST';
        $sparepart = new SparePart();

        return $this->form('Buat Surat Jalan ', $action, $method, $sparepart);

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
            'selesai_id' => 'required|exists:pekerjaan_selesai,id',
        ]);
        
        $selesai = PekerjaanSelesai::find($data['selesai_id']);
        
        // dd($selesai);

        $sparepart_id = $selesai->ccr->rjo->id.'-'.$selesai->ccr->id;
        
        $spare = SparePart::create([
            'id' => $sparepart_id,
            'customer_id' => $selesai->ccr->rjo->customer_id,
            'marketing_id' => $selesai->ccr->rjo->marketing_id,
            'ppc_id' => $selesai->ppc->id,
            'unit_code' => $selesai->ccr->rjo->unit_code,
            'part_name' => $selesai->ccr->rjo->part_name,
            'problem' => $selesai->ccr->rjo->problem,
            'job_desc' => $selesai->ccr->rjo->job_desc,
            'ccr_file' => $selesai->ccr->file,
            'date_received' => $selesai->ccr->rjo->date_received,
            'date_request' => $selesai->ccr->rjo->date_request,
            'date_finish' => $selesai->date_finish,
        ]);

        $route_download = route('sparepart.surat', $spare->id);

        $rjo = Rjo::find($selesai->ccr->rjo->id);
        $rjo->delete();

        return redirect()->route('sparepart.index')->with([
            'success' => 'Data Sparepart berhasil di archive dan surat jalan berhasil dibuat',
            'download' => $route_download
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sparepart = SparePart::find($id);
        
        return view('app.sparepart.show', compact('sparepart'));

    }
    /**
     * Make surat for specified resource.
     *
     * @param  \App\Models\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function surat($id)
    {

        $sparePart = SparePart::find($id);

        $surat_jalan = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/surat/surat_jalan.docx'));

        $date_received = Carbon::parse($sparePart->date_received)->isoFormat('Do MMMM YYYY');
        $date_request = Carbon::parse($sparePart->date_request)->isoFormat('Do MMMM YYYY');
        $date_finish = Carbon::parse($sparePart->date_finish)->isoFormat('Do MMMM YYYY');

        $surat_jalan->setValues([
            'sparepart_id' => $sparePart->id,
            'tanggal' => date('d-M-Y'),
            'customer_name' => $sparePart->customer->nama,
            'customer_address' => $sparePart->customer->address,
            'date_received' => $date_received,
            'date_finish' => $date_finish,
            'unit_code' => $sparePart->unit_code,
            'part_name' => $sparePart->part_name,
            'job_desc' => $sparePart->job_desc,
        ]);

        $name_surat = 'Surat Jalan no.'.$sparePart->id.'.docx';

        $surat_jalan->saveAs($name_surat);

        return response()->download(public_path($name_surat))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function edit(SparePart $sparePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SparePart $sparePart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sparePart = SparePart::find($id);


        $exists = Storage::exists('public/berkas/ccr/'.$sparePart->ccr_file);
        if ($exists) {
            Storage::delete('public/berkas/ccr/'.$sparePart->ccr_file);
        }

        $sparePart->delete();
        
        return redirect()->back()->with('success', 'Data Sparepart berhasil dihapus');
    }
}
