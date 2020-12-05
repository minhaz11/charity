@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('main_content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-12">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible bg-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {!! \Session::get('success') !!}
            </div>
            @endif
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Message</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="message-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($contacts as $contact)
                  <tr>
                    <td>{{ $contact['name'] }}</td>
                    <td>{{ $contact['email'] }}</td>
                    <td>{{ $contact['subject'] }}</td>
                    <td>{{ $contact['message'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($contact['created_at'])->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ url('contact/delete') . '/' . $contact['id'] }}" class="btn btn-square btn-danger text-white" title="Delete"><i class="fas fa-trash"></i></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection

@push('footer_js')
<script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $('#message-table').DataTable({
      "paging": true,
       columnDefs: [
            { width: 100, targets: 0 },
            { width: 200, targets: 1 },
            { width: 200, targets: 2 },
            { width: 300, targets: 3 },
            { width: 50, targets: 4 },
        ],
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
@endpush