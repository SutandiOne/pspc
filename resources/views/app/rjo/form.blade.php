
@extends('layout.dash')

@section('head')
    <link rel="stylesheet" href="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/css/bootstrap-select.css')}}" />
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
                        <label for="customer_id" class="col-form-label">Customer</label>
                        <select class="form-control selectpicker  @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" data-live-search="true">
                            <option></option>
                        @foreach ($customer as $cs)
                            <option value="{{ $cs->id }}" 
                                {{ (old('customer_id') ?? $rjo->customer->id) == $cs->id ? 'selected' : ''}} 
                                data-subtext="{{$cs->id}}"
                                >
                                {{$cs->nama}}
                            </option>
                        @endforeach
                        </select>
                    
                        @error('customer_id')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_received" class="col-form-label">Date Received</label>
                        <div class="input-group date" id="date_received" data-target-input="nearest">
                            <div class="input-group-append" data-target="#date_received" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            <input type="text" name="date_received" value="{{ old('date_received') ?? $rjo->date_received }}" class="form-control datetimepicker-input @error('date_received') is-invalid @enderror" data-target="#datetimepicker1" />
                        </div>
                        @error('date_received')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_request" class="col-form-label">Date Request</label>
                        <div class="input-group date" id="date_request" data-target-input="nearest">
                            <div class="input-group-append" data-target="#date_request" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                            <input type="text" name="date_request" value="{{ old('date_request') ?? $rjo->date_request }}" class="form-control datetimepicker-input @error('date_request') is-invalid @enderror" data-target="#datetimepicker1" />
                        </div>
                        @error('date_request')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                   
                    
                    <div class="form-group">
                        <label for="unit_code" class="col-form-label">Unit Code</label>
                        <input id="unit_code" name="unit_code" type="number" value="{{ old('unit_code') ?? $rjo->unit_code }}" class="form-control @error('unit_code') is-invalid @enderror">
                        @error('unit_code')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="part_name" class="col-form-label">Part Name</label>
                        <input id="part_name" name="part_name" type="text" value="{{ old('part_name') ?? $rjo->part_name }}" class="form-control @error('part_name') is-invalid @enderror">
                        @error('part_name')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="problem" class="col-form-label">Problem</label>
                        <textarea class="form-control @error('problem') is-invalid @enderror" id="problem" name="problem" rows="3">{{ old('problem') ?? $rjo->problem }}</textarea>
                        @error('problem')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="job_desc" class="col-form-label">Job Description</label>
                        <textarea class="form-control @error('job_desc') is-invalid @enderror" id="job_desc" name="job_desc" rows="3">{{ old('job_desc') ?? $rjo->job_desc }}</textarea>
                        @error('job_desc')
                            <div class="invalid-feedback" >
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('rjo.index')}}">Kembali</a>
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
<script src="{{asset('assets/vendor/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script>
    $(function () {
        $('#date_received').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#date_request').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
@endsection