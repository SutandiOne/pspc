
@extends('layout.dash')

@section('head')
    
    @include('layout.lib.DatatablesCSS')

@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Pengguna</h2>

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
                    <table id="datatabel" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Email</th>
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
          $('#datatabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.list') }}",
            "searching": true,
            columns: [
              { data: 'username', name: 'username' },
              { data: 'role', name: 'role' },
              { data: 'email', name: 'email' },
              { data: 'aksi', name: 'aksi', orderable: false, searchable: false},
            ],
            "responsive": true,
          });
        });
      </script>
@endsection