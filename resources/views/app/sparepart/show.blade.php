
@extends('layout.dash')


@section('content')

<div>

    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title">Data Sparepart {{$sparepart->id}}</h2>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-12">
        <div class="col-12">
            <div class="card">
                <div class="card-body bg-primary">
                
                        <div class="user-avatar float-xl-left pr-4 float-center">
                            <img src="https://ui-avatars.com/api/?name={{$sparepart->customer->nama}}&background=fff&rounded=true" alt="User Avatar" class="rounded-circle user-avatar-xl">
                        </div>
                        <div class="pl-xl-3">
                            <div class="m-b-0">
                                <div class="user-avatar-name d-inline-block">
                                    <h2 class="font-24 m-b-10 text-white">{{$sparepart->customer->nama}}</h2>
                                </div> 
                            </div>
                            <div class="user-avatar-address">
                                <p class="mb-2">
                                    <span class="badge badge-light">Customer</span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-phone mr-2  text-light"></i>{{$sparepart->customer->no_telepon}} &nbsp;
                                           
                                </p>
                                <p class="mb-2"><i class="fa fa-map-marker-alt mr-2  text-light"></i>{{$sparepart->customer->address}} 
                                </p> 
                            </div>
                        </div>
                         
                </div>
                   
            </div>
            {{-- end card --}}
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  
                        <div class="user-avatar float-xl-left pr-4 float-none">
                            <img src="https://ui-avatars.com/api/?name={{$sparepart->marketing->nama}}&background=random&rounded=true" alt="User Avatar" class="rounded-circle user-avatar-xl">
                        </div>
                        <div class="pl-xl-3">
                            <div class="m-b-0">
                                <div class="user-avatar-name d-inline-block">
                                    <h2 class="font-24 m-b-10">{{$sparepart->marketing->nama}}</h2>
                                </div> 
                            </div>
                            <div class="user-avatar-address">
                                <p class="mb-2">
                                    <span class="badge badge-light">Staff Marketing</span><span class="m-l-10">{{$sparepart->marketing->gender}}<span class="m-l-15">{{$sparepart->marketing->umur}} Tahun</span></span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-phone mr-2  text-primary"></i>{{$sparepart->marketing->no_hp}} &nbsp;
                                    <i class="fas fa-envelope-open mr-2  text-primary"></i>{{$sparepart->marketing->user->email}}           
                                </p>
                                <p class="mb-2"><i class="fa fa-map-marker-alt mr-2  text-primary"></i>{{$sparepart->marketing->alamat}} 
                                </p> 
                            </div>
                        </div>
                         
                </div>
                   
            </div>
            {{-- end card --}}
        </div>
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  
                        <div class="user-avatar float-xl-left pr-4 float-none">
                            <img src="https://ui-avatars.com/api/?name={{$sparepart->ppc->nama}}&background=random&rounded=true" alt="User Avatar" class="rounded-circle user-avatar-xl">
                        </div>
                        <div class="pl-xl-3">
                            <div class="m-b-0">
                                <div class="user-avatar-name d-inline-block">
                                    <h2 class="font-24 m-b-10">{{$sparepart->ppc->nama}}</h2>
                                </div> 
                            </div>
                            <div class="user-avatar-address">
                                <p class="mb-2">
                                    <span class="badge badge-light">Staff PPC</span><span class="m-l-10">{{$sparepart->ppc->gender}}<span class="m-l-15">{{$sparepart->ppc->umur}} Tahun</span></span>
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-phone mr-2  text-primary"></i>{{$sparepart->ppc->no_hp}} &nbsp;
                                    <i class="fas fa-envelope-open mr-2  text-primary"></i>{{$sparepart->ppc->user->email}}           
                                </p>
                                <p class="mb-2"><i class="fa fa-map-marker-alt mr-2  text-primary"></i>{{$sparepart->ppc->alamat}} 
                                </p> 
                            </div>
                        </div>
                         
                </div>
                   
            </div>
            {{-- end card --}}
        </div>
    </div>
    <div class=" col-md-8 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12 text-center">
                        <div class="icon-box-lg icon-circle-medium bg-primary mb-2" >
                            <i class="fas fa-ticket-alt fa-fw fa-sm"></i>
                        </div> 
                        <h4>Repair Job Order </h4>
                        <span class="badge badge-light">Kode No : {{$sparepart->rjo}}</span>
                    </div>
                    <div class="col-md-3 col-12">
                        <ul class="list-group list-group-flush text-dark">
                            <li class="list-group-item">Unit Kode : {{$sparepart->unit_code}}</li>
                            <li class="list-group-item">Part Name : {{$sparepart->part_name}}</li>
                            <li class="list-group-item">Date Received : {{$sparepart->date_received}}</li>
                            <li class="list-group-item">Date Request  : {{$sparepart->date_request}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="list-unstyled mt-2">
                            <li class="media"> 
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">{{$sparepart->problem}}</h5> {{$sparepart->job_desc}}
                                </div>
                            </li>
                           
                        </ul>
                    </div>
                   
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-3 col-12 text-center">
                        <div class="icon-box-lg icon-circle-medium bg-primary mb-2" >
                            <i class="fas fa-clipboard-list fa-fw fa-sm"></i>
                        </div> 
                        <h4>Component Condition Report</h4>
                        <span class="badge badge-light">Kode No : {{$sparepart->rjo}}</span>

                    </div>
                    <div class="col-md-9 col-12">
                        <ul class="list-group list-group-flush text-dark">
                            <li class="list-group-item">CCR File : <a class="text-secondary" href="{{route('sparepart.file', $sparepart->id)}}"><i class="fas fa-file"></i> {{$sparepart->ccr_file}}</a></li>
                            <li class="list-group-item">Surat Perintah Kerja : <a class="text-secondary" href="{{route('sparepart.perintah', $sparepart->id)}}"><i class="fas fa-file"></i> ccr_no.{{$sparepart->ccr}}.docx</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-12 text-center">
                        <div class="icon-box-lg icon-circle-medium bg-primary mb-2" >
                            <i class="fas fa-tasks fa-fw fa-sm"></i>
                        </div> 
                        <h4>Pekerjaan Selesai</h4>
                        <hr>
                    </div>
                    <div class="col-md-9 col-12">
                        <ul class="list-group list-group-flush text-dark">
                            <li class="list-group-item">Date Finish : {{$sparepart->date_finish}}</li>
                            <li class="list-group-item">Surat Jalan : <a class="text-secondary" href="{{route('sparepart.surat', $sparepart->id)}}"><i class="fas fa-file"></i> sparepart_id.{{$sparepart->id}}.docx</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9 col-12">
                       
                    </div>
                    <div class="col-md-3 col-12 text-center">
                        <h4>Konfirmasi Hapus Data</h4>
                        <a class="icon-box-lg text-white icon-circle-medium bg-danger mb-2" data-toggle="modal" data-target="#confirmDelete" >
                            <i class="fas fa-trash fa-fw fa-sm"></i>
                        </a> 
                        <hr>
                    </div>
                </div>
       
            </div>
        </div> 
    </div>  
</div>


<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST">
            @method('DELETE')
            @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Data Sparepart #{{$sparepart->id}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda ingin menghapus data ini dari database?, <span class="text-danger"> data yang sudah dihapus tidak dapat dikembalikan lagi!</span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">❌ Batal</button>
                    <button type="submit" class="btn btn-primary">✔ Setuju</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

