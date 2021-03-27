
@extends('layout.dash')

@section('head')
    
    <link rel="stylesheet" href="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css')}}" />
    
    @include('layout.lib.DatatablesCSS')

@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Pekerjaan Selesai</h2>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex" >
                @include('layout.com.alert')
                <div class="toolbar ml-auto">
                    <a href="{{route($rAdd)}}" class="btn btn-primary float-right">Buat Konfirmasi</a>
                </div>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <div class="form-row text-right">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <div class="input-group date" id="from" data-target-input="nearest">
                                <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <input type="text" id="from" name="from" placeholder="From"  class="form-control datetimepicker-input data-target="#datetimepicker1" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <div class="input-group date" id="to" data-target-input="nearest">
                                <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <input type="text" id="to" name="to" placeholder="To"  class="form-control datetimepicker-input data-target="#datetimepicker1" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <button id="btn_search" class="btn btn-sm btn-primary btn-block">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatabel" class="table table-striped table-bordered first nowrap dt-responsive" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>CCR No.</th>
                                <th>Di Konfirmasi PPC</th>
                                <th>Date Received</th>
                                <th>Date Request</th>
                                <th>Date Finish</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @include('layout.lib.DatatablesJS')
    <script src="{{asset('assets/vendor/datepicker/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.js')}}"></script>
    <script>
        $(function () {

           
            $('#from').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#to').datetimepicker({
                format: 'YYYY-MM-DD'
            });

        
            var date = new Date()
            
            function title(){
                title = 'Export Data Pekerjaan Selesai ' + $('input[name=from]').val() +' - '+ $('input[name=to]').val()
                return title
            }
            
            var desc = 'The information in this table is copyright to SSC Works'
            var bottom = 'Export Date '+ date

            $('#btn_search').click(function(){
                table.draw();
            });
            

            var table = $('#datatabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: { 
                    url : "{{ route('selesai.list') }}",
                
                    data: function (d) {
                        d.from = $('input[name=from]').val();
                        d.to = $('input[name=to]').val();
                    },
                },
                "searching": true,
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)'
                        }
                    },
                    {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                        }
                    },
                    {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:last-child)'
                        }
                    },
                    {
                    extend: 'print',
                        title: title,
                        messageTop: desc,
                        messageBottom: bottom,
                    exportOptions: {
                        columns: ':not(:last-child)'
                        }
                    }
                ],    
                columns: [
                { data: 'ccr_id', name: 'ccr_id' },
                { data: 'nama', name: 'nama' },
                { data: 'date_received', name: 'date_received' },
                { data: 'date_request', name: 'date_request' },
                { data: 'date_finish', name: 'date_finish' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false},
                ],
                "responsive": true,
            });
          
        });
      </script>
@endsection