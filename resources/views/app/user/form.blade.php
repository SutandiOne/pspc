
@extends('layout.dash')



@section('content')

<div>

    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title">{{$title}}</h2>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @include('layout.com.alert')
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" action="{{$action}}" method="POST" novalidate>
                    @method($method)
                    @csrf

                    @if ($method == 'POST')
                        
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select class="form-control @error('role') is-invalid @enderror" id="input-select" name="role">
                            <option value="admin" {{ (old('role') ?? $user->role ) == 'admin' ? 'selected' : ''}} >Admin</option>
                            <option value="manager" {{ (old('role') ?? $user->role  ) == 'manager' ? 'selected' : ''}} >Manager</option>
                        </select>
                        
                        @error('role')
                        <div class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username') ?? $user->username}}" />
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? $user->email}}" />
                        @error('email')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @if ($method != 'POST')
                    <p class="text-danger">* Kosongkan Password jika tidak ingin merubah</p>
                    @endif
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback" role="alert" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Konfirmasi Password</label>
                        <input id="confirm-password" name="confirm-password" type="password"  class="form-control @error('confirm-password') is-invalid @enderror" />
                        @error('confirm-password')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('user.index')}}">Kembali</a>
                        <button class="btn btn-primary text-white" type="submit">Simpan</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
   
    
</div>
@endsection

