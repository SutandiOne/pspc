
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
    <div class=" col-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" action="{{$action}}" method="POST" novalidate>
                    @method($method)
                    @csrf
                    
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input id="nama" name="nama" type="text" value="{{ old('nama') ?? $customer->nama }}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="no_telepon" class="col-form-label">Nomor Telepon</label>
                        <input id="no_telepon" name="no_telepon" type="text" value="{{ old('no_telepon') ?? $customer->no_telepon }}" class="form-control @error('no_telepon') is-invalid @enderror">
                        @error('no_telepon')
                        <div class="invalid-feedback" >
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') ?? $customer->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback" >
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('customer.index')}}">Kembali</a>

                        <button class="btn btn-primary text-white" type="submit">Simpan</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
   
    
</div>
@endsection

