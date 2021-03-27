
@extends('layout.dash')


@section('content')

<div>

    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title">{{$sparepart->id}}</h2>            
        </div>
    </div>
</div>

<div class="row">

    <div class=" col-12">
        <div class="card">
            <div class="card-header pills-regular">
                <ul class="nav nav-pills card-header-pills" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="card-pills-1" data-toggle="tab" href="#card-pill-1" role="tab" aria-controls="card-1" aria-selected="true">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-pills-2" data-toggle="tab" href="#card-pill-2" role="tab" aria-controls="card-2" aria-selected="false">Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-pills-3" data-toggle="tab" href="#card-pill-3" role="tab" aria-controls="card-3" aria-selected="false">PPC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-pills-4" data-toggle="tab" href="#card-pill-4" role="tab" aria-controls="card-4" aria-selected="false">Marketing</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="card-pill-1" role="tabpanel" aria-labelledby="card-tab-1">
                        <div class="form-group row">
                            <label for="d-ccrid" class="col-3 col-lg-2 col-form-label text-right">CCR No.</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-ccrid" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-daterequest" class="col-3 col-lg-2 col-form-label text-right">Date Request</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-daterequest" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-datereceived" class="col-3 col-lg-2 col-form-label text-right">Date Received</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-datereceived" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-datefinish" class="col-3 col-lg-2 col-form-label text-right">Date Finish</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-datefinish" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-unitcode" class="col-3 col-lg-2 col-form-label text-right">Unit Code</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-unitcode" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-partname" class="col-3 col-lg-2 col-form-label text-right">Part Name</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-partname" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-problem" class="col-3 col-lg-2 col-form-label text-right">Problem</label>
                            <div class="col-9 col-lg-10">
                                <textarea id="d-problem" class="form-control" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-jobdesc" class="col-3 col-lg-2 col-form-label text-right">Job Desc.</label>
                            <div class="col-9 col-lg-10">
                                <textarea id="d-jobdesc" class="form-control" rows="4" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-pill-2" role="tabpanel" aria-labelledby="card-tab-2">
                        <div class="form-group row">
                            <label for="c-nama" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                            <div class="col-9 col-lg-10">
                                <input id="c-nama" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="c-notelp" class="col-3 col-lg-2 col-form-label text-right">No. Telepon</label>
                            <div class="col-9 col-lg-10">
                                <input id="c-notelp" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="c-address" class="col-3 col-lg-2 col-form-label text-right">Address</label>
                            <div class="col-9 col-lg-10">
                                <textarea id="c-address" class="form-control" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                   
                    <div class="tab-pane fade" id="card-pill-3" role="tabpanel" aria-labelledby="card-tab-3">
                        <div class="form-group row">
                            <label for="p-nama" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                            <div class="col-9 col-lg-10">
                                <input id="p-nama" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p-email" class="col-3 col-lg-2 col-form-label text-right">Email</label>
                            <div class="col-9 col-lg-10">
                                <input id="p-email" type="email" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p-nohp" class="col-3 col-lg-2 col-form-label text-right">No. Handphone</label>
                            <div class="col-9 col-lg-10">
                                <input id="p-nohp" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="p-alamat" class="col-3 col-lg-2 col-form-label text-right">Alamat</label>
                            <div class="col-9 col-lg-10">
                                <textarea id="p-alamat" class="form-control" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="card-pill-4" role="tabpanel" aria-labelledby="card-tab-4">
                        <div class="form-group row">
                            <label for="m-nama" class="col-3 col-lg-2 col-form-label text-right">Nama</label>
                            <div class="col-9 col-lg-10">
                                <input id="m-nama" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="m-email" class="col-3 col-lg-2 col-form-label text-right">Email</label>
                            <div class="col-9 col-lg-10">
                                <input id="m-email" type="email" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="m-nohp" class="col-3 col-lg-2 col-form-label text-right">No. Handphone</label>
                            <div class="col-9 col-lg-10">
                                <input id="m-nohp" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="m-alamat" class="col-3 col-lg-2 col-form-label text-right">Alamat</label>
                            <div class="col-9 col-lg-10">
                                <textarea id="m-alamat" class="form-control" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    
</div>
@endsection

