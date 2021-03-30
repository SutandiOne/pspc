
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
    <div class="col-12 col-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">RJO yang belum diproses</h5>
                        <h2 class="mb-0">Total : {{$total_rjo_belum}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                        <i class="fas fa-ticket-alt fa-fw fa-sm text-brand"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">CCR yang sudah dibuat</h5>
                        <h2 class="mb-0">Total : {{$total_ccr}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                        <i class="fas fa-tasks fa-fw fa-sm text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Belum dibuat surat jalan</h5>
                        <h2 class="mb-0">Total : {{$total_selesai}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                        <i class="fas fa-clipboard-list fa-fw fa-sm text-brand"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Sparepart</h5>
                        <h2 class="mb-0">Total : {{$total_sparepart}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                        <i class="fas fa-archive fa-fw fa-sm text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9">
        <div class="card w-100">
            <h5 class="card-header">Grafik Sparepart tahun ini</h5>
            <div class="card-body">
                <livewire:grafik.admin />
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<livewire:scripts />

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

@livewireChartsScripts

@endsection