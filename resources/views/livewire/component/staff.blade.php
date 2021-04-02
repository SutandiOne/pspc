<div >
    <div class="col-12">

        <div class="card">
            <div class="card-body" wire:ignore >
                <label for="staff" class="h3">Cari Staff</label>
                    <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true" wire:model="staff_id">
                        <option></option>
                    
                        @foreach ($staff as $st)
                        <option
                            data-subtext="{{$st->role}}" 
                            value="{{ $st->id }}" 
                            wire:key="{{$st->id}}" 
                            {{$staff_id == $st->id ? 'selected' : ''}}>
                            {{$st[$st->role]->nama}}
                        </option>
                        @endforeach
                    </select>
            </div>
        </div>
    </div>

    <div class="col-12">
        
        <div class="card">
            <div wire:loading wire:target="staff_id" class="card-header">     
                <h3><span>Lagi memuat... </span><span class="dashboard-spinner spinner-xs"></span> </h3>
            </div>
            <div class="card-body">

                
                    

                <div >

                    @if($staf)
                    
                    

                    <div class="user-avatar float-xl-left pr-4 float-none">
                        <img src="https://ui-avatars.com/api/?name={{$staf[$staf->role]->nama}}&background=random&rounded=true" alt="User Avatar" class="rounded-circle user-avatar-xl">
                    </div>
                    <div class="pl-xl-3">
                        <div class="m-b-0">
                            <div class="user-avatar-name d-inline-block">
                                <h2 class="font-24 m-b-10">{{$staf[$staf->role]->nama}}</h2>
                            </div> 
                        </div>
                        <div class="user-avatar-address">
                            <p class="mb-2">
                                <span class="badge badge-light text-uppercase">Staff {{$staf->role}}</span><span class="m-l-10">{{$staf[$staf->role]->gender}}<span class="m-l-15">{{$staf[$staf->role]->umur}} Tahun</span></span>
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-phone mr-2  text-primary"></i>{{$staf[$staf->role]->no_hp}} &nbsp;
                                <i class="fas fa-envelope-open mr-2  text-primary"></i>{{$staf->email}}          
                            </p>
                            <p class="mb-2"><i class="fa fa-map-marker-alt mr-2  text-primary"></i>{{$staf[$staf->role]->alamat}}
                            </p> 
                        </div>
                    </div>
                    <div class="row">
                        <!-- grid column -->
                        <div class="col-12 text-center">
                            <h4>KINERJA</h4>
                            <hr>
                        </div>
                        <div class="col-4 card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$staf_bulan}} </h6>
                                <p class="metric-label"> Bulan ini </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- /grid column -->
                        <!-- grid column -->
                        <div class="col-4 card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$staf_tahun}} </h6>
                                <p class="metric-label"> Tahun ini </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- /grid column -->
                        <!-- grid column -->
                        <div class="col-4 card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$staf_total}}</h6>
                                <p class="metric-label"> Total </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- /grid column -->
                    </div>
                    
                    @else
                    
                    
                          
                                <div class="user-avatar float-xl-left pr-4 float-none">
                                    <img src="https://ui-avatars.com/api/?name=nama&background=random&rounded=true" alt="User Avatar" class="rounded-circle user-avatar-xl">
                                </div>
                                <div class="pl-xl-3">
                                    <div class="m-b-0">
                                        <div class="user-avatar-name d-inline-block">
                                            <h2 class="font-24 m-b-10">Nama</h2>
                                        </div> 
                                    </div>
                                    <div class="user-avatar-address">
                                        <p class="mb-2">
                                            <span class="badge badge-light">Staff</span><span class="m-l-10">Gender<span class="m-l-15">Umur Tahun</span></span>
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-phone mr-2  text-primary"></i>nohp &nbsp;
                                            <i class="fas fa-envelope-open mr-2  text-primary"></i>email          
                                        </p>
                                        <p class="mb-2"><i class="fa fa-map-marker-alt mr-2  text-primary"></i>alamat
                                        </p> 
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- grid column -->
                                    <div class="col-12 text-center">
                                        <h4>KINERJA</h4>
                                        <hr>
                                    </div>
                                    <div class="col-4 card-footer-item-bordered">
                                        <!-- .metric -->
                                        <div class="metric">
                                            <h6 class="metric-value"> 0 </h6>
                                            <p class="metric-label"> Bulan ini </p>
                                        </div>
                                        <!-- /.metric -->
                                    </div>
                                    <!-- /grid column -->
                                    <!-- grid column -->
                                    <div class="col-4 card-footer-item-bordered">
                                        <!-- .metric -->
                                        <div class="metric">
                                            <h6 class="metric-value"> 0 </h6>
                                            <p class="metric-label"> Tahun ini </p>
                                        </div>
                                        <!-- /.metric -->
                                    </div>
                                    <!-- /grid column -->
                                    <!-- grid column -->
                                    <div class="col-4 card-footer-item-bordered">
                                        <!-- .metric -->
                                        <div class="metric">
                                            <h6 class="metric-value"> 0 </h6>
                                            <p class="metric-label"> Total </p>
                                        </div>
                                        <!-- /.metric -->
                                    </div>
                                    <!-- /grid column -->
                                </div>
                       
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
