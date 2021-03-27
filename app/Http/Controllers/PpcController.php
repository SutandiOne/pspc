<?php

namespace App\Http\Controllers;

use App\Models\Ppc;
use App\Models\User;
use Illuminate\Http\Request;

class PpcController extends Controller
{

    public function list()
    {
        if (request()->ajax()) {
            
            //user
            $PPC = Ppc::with('user:id,username,email')->get();

            return datatables()->of($PPC)
                ->editColumn('akun', function($data){
                    return $data->user->username.' | '.$data->user->email;
                })
                ->addColumn('aksi', function($data){

                    $rDel = 'ppc.destroy';
                    $rEdit = 'ppc.edit';
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
        $rAdd = 'ppc.create';
        
        return view('app.ppc.index', compact('rAdd'));
    }

     //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $ppc)
    {  
        
        return view('app.ppc.form', compact('title', 'action', 'method', 'ppc'));
    }
    //-------------------------------------------------------------------------------------------------------------------------



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('ppc.store');
        $method = 'POST';
        $ppc = new Ppc();
        $ppc->user = new User();

        return $this->form('Tambah Staff PPC ', $action, $method, $ppc);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataUser = request()->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users',  
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password|min:6'
        ]);

        $dataPPC = request()->validate([
            'nama' => 'required|string|max:120',
            'gender' => 'required|string|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:190',
            'no_hp' => 'required|string|max:20'
        ]);

        $dataUser['password'] = \bcrypt($dataUser['password']);
        $dataUser['role'] = 'ppc';

        $user = User::create($dataUser);

        $user->ppc()->create($dataPPC);    

        return redirect()->route('ppc.index')->with('success', 'Data Staff PPC berhasil dimasukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ppc  $ppc
     * @return \Illuminate\Http\Response
     */
    public function show(Ppc $ppc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ppc  $ppc
     * @return \Illuminate\Http\Response
     */
    public function edit(Ppc $ppc)
    {
        $action = route('ppc.update', $ppc->id);
        $method = 'PATCH';

        return $this->form('Ubah Staff PPC', $action, $method, $ppc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ppc  $ppc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ppc $ppc)
    {

        if (request()->input('password') == null) {
            
            $dataUser = request()->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.$ppc->user->id
            ]);

        }else{

            $dataUser = request()->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.$ppc->user->id,
                'password' => 'required|min:6',
                'confirm-password' => 'required|same:password|min:6'
            ]);

            $dataUser['password'] = \bcrypt($dataUser['password']);

        }

        $dataPPC = request()->validate([
            'nama' => 'required|string|max:120',
            'gender' => 'required|string|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:190',
            'no_hp' => 'required|string|max:20'
        ]);

        $ppc->update($dataPPC);

        $ppc->user->update($dataUser);
        
        return redirect()->route('ppc.index')->with('success', 'Data Staff PPC '.$ppc->nama.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ppc  $ppc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ppc $ppc)
    {
        $nama = $ppc->nama;

        $user = User::find($ppc->user->id);
        $user->delete();

        return redirect()->back()->with('success', 'Data Staff PPC '.$nama.' berhasil dihapus');
    }
}
