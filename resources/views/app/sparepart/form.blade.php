
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
                
                <form class="needs-validation" action="{{$action}}" method="POST" novalidate>
                    @method($method)
                    @csrf
                    
                    <div class="form-group">
                        <label for="selesai_id" class="col-form-label">Pilih Pekerjaan Selesai</label>
                        
                        <select class="form-control selectpicker  @error('selesai_id') is-invalid @enderror" id="selesai_id" name="selesai_id" data-live-search="true">
                            <option></option>
                           
                            @foreach ($selesai as $s)
                            <option value="{{ $s->id }}" 
                                {{ old('selesai_id') == $s->id ? 'selected' : ''}}>
                                no.{{$s->id}}\{{$s->date_finish}}
                            </option>
                            @endforeach
                        </select>

                         
                            
                        @error('selesai_id')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group text-right">
                        <br>
                        <a class="btn btn-light border text-dark float-left" href="{{route('sparepart.index')}}">Kembali</a>
                        <button class="btn btn-primary text-white" type="submit">Buat</button>
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
                    url: "{{route('selesai.select')}}",
                    data: {id:id},
                    success: function (data) {
                        // console.log(data);
                        //Detail
                        $("#d-ccrid").val(data.ccr_id);
                        $("#d-daterequest").val(data.date_request);
                        $("#d-datereceived").val(data.date_received);
                        $("#d-datefinish").val(data.date_finish);
                        $("#d-unitcode").val(data.unit_code);
                        $("#d-partname").val(data.part_name);
                        $("#d-problem").val(data.problem);
                        $("#d-jobdesc").val(data.job_desc);
                        //customer
                        $("#c-nama").val(data.customer.nama);
                        $("#c-notelp").val(data.customer.no_telepon);
                        $("#c-address").val(data.customer.address);
                        //ppc
                        $("#p-nama").val(data.ppc.nama);
                        $("#p-email").val(data.ppc_email);
                        $("#p-nohp").val(data.ppc.no_hp);
                        $("#p-alamat").val(data.ppc.alamat);
                        //marketing
                        $("#m-nama").val(data.marketing.nama);
                        $("#m-email").val(data.marketing_email);
                        $("#m-nohp").val(data.marketing.no_hp);
                        $("#m-alamat").val(data.marketing.alamat);

                    },
                    error: function(e) { 
                        console.error(e);
                    }
                });
            }
        }
        
        select();

        $(".selectpicker" ).change(function() {
            select();
        });
        
        $('#date_finish').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    });
</script>
@endsection

