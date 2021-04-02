
@extends('layout.dash')

@section('head')

<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/css/bootstrap-select.css')}}" />
<livewire:styles />
@endsection


@section('content')

<div>

    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title">Statistik Staff</h2>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-12">
        
        
        <livewire:component.staff :staff="$staff" />
             
    </div>
    <div class="col-md-4 col-12">
        <livewire:stats.staff />
    </div>
</div>

@endsection

@section('script')

<livewire:scripts />

<script src="{{asset('assets/vendor/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>


@livewireChartsScripts

@endsection
