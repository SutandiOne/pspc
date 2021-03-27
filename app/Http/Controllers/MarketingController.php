<?php

namespace App\Http\Controllers;

use App\Models\Marketing;
use App\Models\User;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function list()
    {
        if (request()->ajax()) {
            
            //user
            $marketing = Marketing::with('user');

            return datatables()->of($marketing)
                ->editColumn('akun', function($data){
                    return $data->user->username.' | '.$data->user->email;
                })
                ->addColumn('aksi', function($data){

                    $rDel = 'marketing.destroy';
                    $rEdit = 'marketing.edit';
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
        $rAdd = 'marketing.create';
        
        return view('app.marketing.index', compact('rAdd'));
    }

     //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $marketing)
    {  
        
        return view('app.marketing.form', compact('title', 'action', 'method', 'marketing'));
    }
    //-------------------------------------------------------------------------------------------------------------------------



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('marketing.store');
        $method = 'POST';
        $marketing = new Marketing();
        $marketing->user = new User();

        return $this->form('Tambah Staff PPC ', $action, $method, $marketing);
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

        $dataMarketing = request()->validate([
            'nama' => 'required|string|max:120',
            'gender' => 'required|string|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:190',
            'no_hp' => 'required|string|max:20'
        ]);

        $dataUser['password'] = \bcrypt($dataUser['password']);
        $dataUser['role'] = 'marketing';

        $user = User::create($dataUser);

        $user->marketing()->create($dataMarketing);    

        return redirect()->route('marketing.index')->with('success', 'Data Staff Marketing berhasil dimasukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function show(Marketing $marketing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function edit(Marketing $marketing)
    {
        $action = route('marketing.update', $marketing->id);
        $method = 'PATCH';

        return $this->form('Ubah Staff Marketing', $action, $method, $marketing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marketing $marketing)
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

        $dataMarketing = request()->validate([
            'nama' => 'required|string|max:120',
            'gender' => 'required|string|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:190',
            'no_hp' => 'required|string|max:20'
        ]);

        $marketing->update($dataMarketing);

        $marketing->user->update($dataUser);
        
        return redirect()->route('marketing.index')->with('success', 'Data Staff Marketing '.$marketing->nama.' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marketing  $marketing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marketing $marketing)
    {
        $nama = $marketing->nama;
        $user = User::find($marketing->user->id);
        $user->delete();

        return redirect()->back()->with('success', 'Data Staff Marketing '.$nama.' berhasil dihapus');
    }
}
