
@extends('layout.dash')

@section('head')
<livewire:styles />
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Dashboard</h2>            
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h3 class="text-center"></h3>
    </div>
</div>

@endsection

@section('script')

<livewire:scripts />

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

@livewireChartsScripts

@endsection