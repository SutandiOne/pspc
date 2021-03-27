
@extends('layout.dash')

@section('head')
    
    @include('layout.lib.DatatablesCSS')

@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Staff PPC</h2>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex" >
                @include('layout.com.alert')
                <div class="toolbar ml-auto">
                    <a href="{{route($rAdd)}}" class="btn btn-primary float-right">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatabel" class="table table-striped table-bordered first nowrap dt-responsive" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Akun</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Tanggal Lahir</th>
                                <th>Nomor Handphone</th>
                                <th>Alamat</th>
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

    <script>
        $(function () {


            var date = new Date()
            var title = 'Export Data Staff PPC';
            var desc = 'The information in this table is copyright to SSC Works'
            var bottom = 'Export Date '+ date

          $('#datatabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ppc.list') }}",
            "searching": true,
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'csv',
                title: title,
                messageTop: desc,
                messageBottom: bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                },
                {
                extend: 'excel',
                title: title,
                messageTop: desc,
                messageBottom: bottom,
                exportOptions: {
                    columns: ':not(:last-child)'
                    }
                },
                {
                extend: 'pdf',
                title: title,
                messageTop: desc,
                messageBottom: bottom,
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
              { data: 'akun', name: 'akun' },
              { data: 'nama', name: 'nama' },
              { data: 'gender', name: 'gender' },
              { data: 'tanggal_lahir', name: 'tanggal_lahir' },
              { data: 'no_hp', name: 'no_hp' },
              { data: 'alamat', name: 'alamat' },
              { data: 'aksi', name: 'aksi', orderable: false, searchable: false},
            ],
            "responsive": true,
          });
          
        });
      </script>
@endsection