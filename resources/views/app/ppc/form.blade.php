
@extends('layout.dash')

@section('head')
    <link rel="stylesheet" href="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css')}}" />
@endsection

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
    <div class=" col-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" action="{{$action}}" method="POST" novalidate>
                    @method($method)
                    @csrf

                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{old('username') ?? $ppc->user->username}}" />
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? $ppc->user->email}}" />
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

                    
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input id="nama" name="nama" type="text" value="{{ old('nama') ?? $ppc->nama }}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="input-select" name="gender">
                            <option value="L" {{ (old('gender') ?? $ppc->gender ) == 'L' ? 'selected' : ''}} >Laki-laki</option>
                            <option value="P" {{ (old('gender') ?? $ppc->gender ) == 'P' ? 'selected' : ''}} >Perempuan</option>
                        </select>
                    
                        @error('gender')
                            <div class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir</label>
                        <div class="input-group date" id="tanggal_lahir" data-target-input="nearest">
                            <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            <input type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $ppc->tanggal_lahir }}" class="form-control datetimepicker-input @error('tanggal_lahir') is-invalid @enderror" data-target="#datetimepicker1" />
                        </div>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="col-form-label">Nomor Handphone</label>
                        <input id="no_hp" name="no_hp" type="text" value="{{ old('no_hp') ?? $ppc->no_hp }}" class="form-control @error('no_hp') is-invalid @enderror">
                        @error('no_hp')
                        <div class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') ?? $ppc->alamat }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('ppc.index')}}">Kembali</a>
                        <button class="btn btn-primary text-white" type="submit">Simpan</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
   
    
</div>
@endsection

@section('script')
<script src="{{asset('assets/vendor/datepicker/moment.js')}}"></script>
<script src="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js')}}"></script>
<script>
    $(function () {
        $('#tanggal_lahir').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
@endsection