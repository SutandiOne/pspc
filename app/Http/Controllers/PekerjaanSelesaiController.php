<?php

namespace App\Http\Controllers;

use App\Models\Ccr;
use App\Models\Ppc;
use App\Models\Rjo;
use App\Models\Marketing;
use Illuminate\Http\Request;
use App\Models\PekerjaanSelesai;
use Illuminate\Support\Facades\Auth;

class PekerjaanSelesaiController extends Controller
{
    public function list(Request $request)
    {
        if (request()->ajax()) {

            $pekerjaan_selesai = PekerjaanSelesai::with(['ccr', 'ppc'])->get();

            if($request->filled('from') && $request->filled('to')){
                
                $from = $request->input('from');
                $to = $request->input('to');
                $pekerjaan_selesai = PekerjaanSelesai::with(['ccr', 'ppc'])->whereBetween('date_finish', [$from, $to])->get();

            }
            //

            return datatables()->of($pekerjaan_selesai)
                
                ->addColumn('nama', function($data){
                    $date = $data->ppc->nama;
                    return $date;
                })
                ->addColumn('date_received', function($data){
                    $date = $data->ccr->rjo->date_received;
                    return $date;
                })
                ->addColumn('date_request', function($data){
                    $date = $data->ccr->rjo->date_request;
                    return $date;
                })
               
                ->addColumn('aksi', function($data){

                    $rDel = 'selesai.destroy';
                    $rEdit = 'selesai.edit';
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
        //Route Define
        $rAdd = 'selesai.create';
        
        return view('app.selesai.index', compact('rAdd'));
    }

     //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $pekerjaan_selesai)
    {  

        $ccr = Ccr::doesntHave('pekerjaan_selesai')->get();
        return view('app.selesai.form', compact('title', 'action', 'method', 'pekerjaan_selesai', 'ccr'));
    }
    //-------------------------------------------------------------------------------------------------------------------------


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('selesai.store');
        $method = 'POST';
        $pekerjaan_selesai = new PekerjaanSelesai();
        $pekerjaan_selesai->ccr = new Ccr();

        return $this->form('Konfirmasi Pekerjaan Selesai ', $action, $method, $pekerjaan_selesai);

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
            'ccr_id' => 'required|exists:ccr,id',
            'date_finish' => 'required|date',
        ]);

        $data['ppc_id'] = Auth::user()->ppc->id;

        PekerjaanSelesai::create($data);

        return redirect()->route('selesai.index')->with('success', 'Konfirmasi Perkerjaan Selesai berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PekerjaanSelesai  $pekerjaanSelesai
     * @return \Illuminate\Http\Response
     */
    public function show(PekerjaanSelesai $pekerjaanSelesai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PekerjaanSelesai  $pekerjaanSelesai
     * @return \Illuminate\Http\Response
     */
    public function edit(PekerjaanSelesai $selesai)
    {
        $action = route('selesai.update', $selesai->id);
        $method = 'PATCH';

        return $this->form('Ubah Data Konfirmasi Pekerjaan Selesai', $action, $method, $selesai); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PekerjaanSelesai  $pekerjaanSelesai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PekerjaanSelesai $pekerjaanSelesai)
    {
        $data = request()->validate([
            'ccr_id' => 'required|exists:ccr,id',
            'date_finish' => 'required|date',
        ]);

        $data['ppc_id'] = Auth::user()->ppc->id;

        $pekerjaanSelesai->update($data);

        return redirect()->route('selesai.index')->with('success', 'Konfirmasi Pekerjaan Selesai berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PekerjaanSelesai  $pekerjaanSelesai
     * @return \Illuminate\Http\Response
     */
    public function destroy(PekerjaanSelesai $selesai)
    {
        $selesai->delete();
        return redirect()->back()->with('success', 'Konfirmasi Pekerjaan Selesai berhasil dihapus');
    }

    public function select(Request $request)
    {
     
        if (request()->ajax()) {

            if ($request->filled('id')) {
                
                $id = $request->input('id');

                $selesai = PekerjaanSelesai::find($id);
                
                $ccr = Ccr::find($selesai->ccr->id);
                
                $rjo = Rjo::with('customer', 'marketing')->find($ccr->rjo->id);

                $marketing = Marketing::find($rjo->marketing->id);
                $ppc = Ppc::find($selesai->ppc->id);

                $rjo['marketing_email'] = $marketing->user->email;
                $rjo['ppc_email'] = $ppc->user->email;
                $rjo['ccr_id'] = $ccr->id;
                $rjo->ppc = $ppc;
                $rjo['date_finish'] = $selesai->date_finish;

                return response()->json($rjo);
            }

            
        }
    }
}
