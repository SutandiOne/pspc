
@extends('layout.dash')

@section('head')
<livewire:styles />
@endsection



@section('content')

<div> 
    <div class="row">
        <div class="col-12">
            <div class="page-header">
            <h2 class="pageheader-title">Statistik Customer</h2>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-body">
                <livewire:stats.customer />
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <h5 class="card-header">Top Customer</h5>
            <div class="card-body p-0">
                <ul class="country-sales list-group list-group-flush">
                    @forelse ($customer as $cus)
                    <li class="list-group-item country-sales-content">
                        <span class="">{{$cus->nama}}</span><span class="float-right text-dark">{{$cus->sparepart_count}}</span>
                    </li>    
                    @empty
                        
                    @endforelse
                    
                   
                </ul>
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