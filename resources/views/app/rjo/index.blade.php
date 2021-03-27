
@extends('layout.dash')

@section('head')
    
    <link rel="stylesheet" href="{{asset('assets/vendor/datepicker/tempusdominus-bootstrap-4.css')}}" />
    
    @include('layout.lib.DatatablesCSS')

@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Repair Job Order</h2>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex" >
                @include('layout.com.alert')
                <div class="toolbar ml-auto">
                    <a href="{{route($rAdd)}}" class="btn btn-primary float-right">Buat</a>
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
                                <input type="text" name="from" placeholder="From"  class="form-control datetimepicker-input data-target="#datetimepicker1" />
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <div class="input-group date" id="to" data-target-input="nearest">
                                <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <input type="text" name="to" placeholder="To"  class="form-control datetimepicker-input data-target="#datetimepicker1" />
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
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Marketing</th>
                                <th>Date Received</th>
                                <th>Date Request</th>
                                <th>Unit Code</th>
                                <th>Part Name</th>
                                <th>Problem</th>
                                <th>Job Description</th>
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
                title = 'Export Data Repair Job Order ' + $('input[name=from]').val() +' - '+ $('input[name=to]').val()
                return title
            }
            var desc = 'The information in this table is copyright to SSC Works'
            var bottom = 'Export Date '+ date
            

        var table = $('#datatabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: { 
                url : "{{ route('rjo.list') }}",
            
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
                title: title,
                messageTop:desc,
                messageBottom:bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                },
                {
                extend: 'excel',
                title: title,
                messageTop:desc,
                messageBottom:bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                },
                {
                extend: 'pdf',
                title: title,
                messageTop:desc,
                messageBottom:bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                },
                {
                extend: 'print',
                title: title,
                messageTop:desc,
                messageBottom:bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                }
            ],    
            columns: [
              { data: 'id', name: 'id' },
              { data: 'customer', name: 'customer' },
              { data: 'marketing', name: 'marketing' },
              { data: 'date_received', name: 'date_received' },
              { data: 'date_request', name: 'date_request' },
              { data: 'unit_code', name: 'unit_code' },
              { data: 'part_name', name: 'part_name' },
              { data: 'problem', name: 'problem' },
              { data: 'job_desc', name: 'job_desc' },
              { data: 'aksi', name: 'aksi', orderable: false, searchable: false},
            ],
            "responsive": true,
          });


        $('#btn_search').click(function(){
            table.draw();
        });

          
        });
      </script>
@endsection