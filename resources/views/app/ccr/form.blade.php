
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

    <div class=" col-md-6 col-12">
        <div class="card">
           
            <div class="card-body">
                
                <form class="needs-validation" action="{{$action}}" method="POST" enctype="multipart/form-data" novalidate>
                    @method($method)
                    @csrf
                    
                    <div class="form-group">
                        <label for="rjo_id" class="col-form-label">Pilih Repair Job Order</label>
                        
                        <select class="form-control selectpicker  @error('rjo_id') is-invalid @enderror" id="rjo_id" name="rjo_id" data-live-search="true">
                            <option></option>
                            @if ($ccr->rjo->id)
                            <option value="{{ $ccr->rjo->id }}" selected>
                                no.{{$ccr->rjo->id}}\{{$ccr->rjo->date_received}} | {{$ccr->rjo->customer_nama()}} | {{$ccr->rjo->unit_code}}:{{$ccr->rjo->part_name}}
                            </option>
                            
                            @endif
                            @foreach ($rjo as $rj)
                            <option value="{{ $rj->id }}" 
                                {{ (old('rjo_id') ?? $ccr->rjo->id) == $rj->id ? 'selected' : ''}}>
                                no.{{$rj->id}}\{{$rj->date_received}} | {{$rj->customer_nama()}} | {{$rj->unit_code}}:{{$rj->part_name}}
                            </option>
                            @endforeach
                        </select>

                         
                            
                        @error('rjo_id')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @if($ccr->file)
                    <div class="form-group">
                        <br>
                        <label for="">Download Surat Perintah Kerja yang telah dibuat : <a  class="text-primary" href="{{route('ccr.surat', $ccr->id)}}"><i class="fas fa-file-word"></i> ccr_no.{{$ccr->id}}.docx</a></label>
                        <br>
                        <label for="">Download CCR File : <a  class="text-primary" href="{{route('ccr.file', $ccr->id)}}"><i class="fas fa-file-word"></i> {{$ccr->file}}</a></label>
                        <br>
                        <label class="text-danger">*Kosongkan jika tidak ingin mengubah ccr file</label>
                    </div>
                    @else
                    <div class="form-group">
                        <label for="">CCR File</label>
                    </div>
                    @endif

                    <div class="custom-file mb-3 form-group">
                        <input type="file" name="file" class="custom-file-input form-control @error('file') is-invalid @enderror" id="file">
                        <label class="custom-file-label" for="file">Klik disini untuk memasukan ccr file</label>
                        @error('file')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    
                    
                    
                    
                    <div class="form-group">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('ccr.index')}}">Kembali</a>
                        <button class="btn btn-primary text-white float-right" type="submit">Simpan</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div class=" col-md-6 col-12">
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
                        <a class="nav-link" id="card-pills-3" data-toggle="tab" href="#card-pill-3" role="tab" aria-controls="card-3" aria-selected="false">Marketing</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="card-pill-1" role="tabpanel" aria-labelledby="card-tab-1">
                        <div class="form-group row">
                            <label for="d-datereceived" class="col-3 col-lg-2 col-form-label text-right">Date Received</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-datereceived" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="d-daterequest" class="col-3 col-lg-2 col-form-label text-right">Date Request</label>
                            <div class="col-9 col-lg-10">
                                <input id="d-daterequest" type="text" class="form-control" readonly>
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

@section('script')
<script src="{{asset('assets/vendor/datepicker/moment.js')}}"></script>
<script src="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script>
    $(function () {

        
        function select(){
            
            var id = $(".selectpicker" ).val();

            if(id){

                $.ajax({
                    type: 'GET',
                    url: "{{route('rjo.select')}}",
                    data: {id:id},
                    success: function (data) {
                        // console.log(data);
                        //Detail
                        $("#d-datereceived").val(data.date_received);
                        $("#d-daterequest").val(data.date_request);
                        $("#d-unitcode").val(data.unit_code);
                        $("#d-partname").val(data.part_name);
                        $("#d-problem").val(data.problem);
                        $("#d-jobdesc").val(data.job_desc);
                        //customer
                        $("#c-nama").val(data.customer.nama);
                        $("#c-notelp").val(data.customer.no_telepon);
                        $("#c-address").val(data.customer.address);
                        //marketing
                        $("#m-nama").val(data.marketing.nama);
                        $("#m-email").val(data.marketing_email);
                        $("#m-nohp").val(data.marketing.no_hp);
                        $("#m-alamat").val(data.marketing.alamat);

                    },
                    error: function() { 
                        console.log(data);
                    }
                });
            }
        }
        
        select();

        $(".selectpicker" ).change(function() {
            select();
        });
        
        $('#date_request').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    });
</script>
@endsection

