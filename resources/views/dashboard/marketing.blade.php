
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
                        <h5 class="text-muted">Total Customer</h5>
                        <h2 class="mb-0"> {{$total_customer}} </h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Jumlah RJO yang Berjalan</h5>
                        <h2 class="mb-0"> {{$total_rjo_berjalan}}</h2>
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
                        <h5 class="text-muted">Jumlah RJO yang Selesai</h5>
                        <h2 class="mb-0"> {{$total_rjo_selesai}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                        <i class="fas fa-ticket-alt fa-fw fa-sm text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-9 col-12">
        <div class="card">
            <h5 class="card-header">Grafik RJO Tahun Ini</h5>
            <div class="card-body">
                <livewire:grafik.marketing />
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