<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    

    public function list()
    {
        if (request()->ajax()) {
            
            //user
            $user = User::whereIn('role', ['admin','manager'])->whereNotIn('id', [Auth::user()->id, 1])->get();

            return datatables()->of($user)
                ->editColumn('username', function($data){
                    return $data->username;
                })
                ->editColumn('email', function($data){
                    return $data->email;
                })
                ->editColumn('role', function($data){
                    return $data->role;
                })
               
                ->addColumn('aksi', function($data){

                    $rDel = 'user.destroy';
                    $rEdit = 'user.edit';
                    $rShow = null;
                    $rFile = null;


                    return view('layout.com.action', compact('data','rEdit','rDel','rShow','rFile'))->render();


                })
                ->rawColumns(['aksi'])
                ->make(true);

        }
    }


    public function index()
    {
        //Route Define
        $rAdd = 'user.create';
        
        return view('app.user.index', compact('rAdd'));
    }

    //-------------------------------------------------------------------------------------------------------------------------
    // Form Builder
    public function form($title, $action, $method, $user)
    {  
        
        return view('app.user.form', compact('title', 'action', 'method', 'user'));
    }
    //-------------------------------------------------------------------------------------------------------------------------



    public function create()
    {
        $action = route('user.store');
        $method = 'POST';
        $user = new User();

        return $this->form('Tambah Pengguna ', $action, $method, $user);
    }


    public function store()
    {
        $data = request()->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users',  
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password|min:6',
            'role' => 'required|string|in:admin,manager'  
        ]);
        
        $data['password'] = \bcrypt($data['password']);

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data User berhasil dimasukan');
    }

    
    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $action = route('user.update', $user->id);
        $method = 'PATCH';

        return $this->form('Ubah Pengguna', $action, $method, $user);
    }


    public function update(User $user, $route = 'user.index')
    {
        
        if (request()->input('password') == null) {
    		$data = request()->validate([
	            'username' => 'required|string|max:100',
	            'email' => 'required|string|email|unique:users,email,'.$user->id
        	]); 

    	}else{

    		$data = request()->validate([
	            'username' => 'required|string|max:10',
	            'email' => 'required|string|email|unique:users,email,'.$user->id,
	            'password' => 'required|min:6',
                'confirm-password' => 'required|same:password|min:6'
        	]); 
        	
    		$data['password'] = bcrypt($data['password']);	

    	}

        $user->update($data);  

        return redirect()->route($route)->with('success', 'Data User '.$user->username.' berhasil diubah');
    }

  
    public function destroy(User $user)
    {
        $username = $user->username;
        $user->delete();

        return redirect()->back()->with('success', 'Data User '.$username.' berhasil dihapus');
    }


    // Akun

    public function viewAkun()
    {

        return view('app.akun.view');
    }

    public function saveAkun()
    {
        $user = Auth::user();
        $rAkun = 'akun.view';

        return $this->update($user, $rAkun);
    }

    // End Akun

}
