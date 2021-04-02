
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
    <div class="col-12 col-md-8 ">
        <div class="row">

            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Total Customer</h5>
                            <h2 class="mb-0">{{$total_customer}}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                            <i class="fas fa-user fa-fw fa-sm text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Total Staff</h5>
                            <h2 class="mb-0">{{$total_staff}}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                            <i class="fas fa-user fa-fw fa-sm text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Status Terakhir</h5>
            <div class="card-header tab-regular">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="card-tab-1" data-toggle="tab" href="#card-1" role="tab" aria-controls="card-1" aria-selected="true">
                            <span class="badge-dot badge-danger mr-1"></span>  Repair Job Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-tab-2" data-toggle="tab" href="#card-2" role="tab" aria-controls="card-2" aria-selected="false">
                            <span class="badge-dot badge-brand mr-1"></span> Component Condition Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-tab-3" data-toggle="tab" href="#card-3" role="tab" aria-controls="card-3" aria-selected="false">
                            <span class="badge-dot badge-primary mr-1"></span> Pekerjaan Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-tab-4" data-toggle="tab" href="#card-4" role="tab" aria-controls="card-4" aria-selected="false">
                            <span class="badge-dot badge-success mr-1"></span> Telah Dikirim
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="card-1" role="tabpanel" aria-labelledby="card-tab-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Unit Part</th>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Date Received</th>
                                        <th class="border-0">Date Request</th>
                                        <th class="border-0">Diproses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rjo as $data)
                                        
                                    <tr>
                                        
                                        <td>{{$data->unit_code.'-'.$data->part_name}} </td>
                                        <td>{{$data->customer->nama}}</td>
                                        <td>{{$data->date_receiveds}}</td>
                                        <td>{{$data->date_requests}}</td>
                                        <td>{{$data->updated_at->diffForHumans()}} </td>
                                   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-2" role="tabpanel" aria-labelledby="card-tab-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Unit Part</th>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Date Received</th>
                                        <th class="border-0">Date Request</th>
                                        <th class="border-0">Diproses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ccr as $data)
                                        
                                    <tr>
                                        
                                        <td>{{$data->rjo->unit_code.'-'.$data->rjo->part_name}} </td>
                                        <td>{{$data->rjo->customer->nama}}</td>
                                        <td>{{$data->rjo->date_receiveds}}</td>
                                        <td>{{$data->rjo->date_requests}}</td>
                                        <td>{{$data->updated_at->diffForHumans()}} </td>
                                   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-3" role="tabpanel" aria-labelledby="card-tab-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Unit Part</th>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Date Request</th>
                                        <th class="border-0">Date Finish</th>
                                        <th class="border-0">Diproses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selesai as $data)
                                        
                                    <tr>
                                        
                                        <td>{{$data->ccr->rjo->unit_code.'-'.$data->ccr->rjo->part_name}} </td>
                                        <td>{{$data->ccr->rjo->customer->nama}}</td>
                                        <td>{{$data->ccr->rjo->date_requests}}</td>
                                        <td>{{$data->date_finishs}}</td>
                                        <td>{{$data->updated_at->diffForHumans()}} </td>
                                   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-4" role="tabpanel" aria-labelledby="card-tab-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Unit Part</th>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Date Request</th>
                                        <th class="border-0">Date Finish</th>
                                        <th class="border-0">Diproses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kirim as $data)
                                        
                                    <tr>
                                        
                                        <td>{{$data->unit_code.'-'.$data->part_name}} </td>
                                        <td>{{$data->customer->nama}}</td>
                                        <td>{{$data->date_requests}}</td>
                                        <td>{{$data->date_finishs}}</td>
                                        <td>{{$data->updated_at->diffForHumans()}} </td>
                                   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-body">

                <livewire:grafik.manager />
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