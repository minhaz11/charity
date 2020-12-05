@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('title')
All campaigns
@endsection

@section('main_content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Campaigns</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('admin.layouts.common.message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title"><strong>All Campaigns</strong></h3>
                        @can('add_user')
                        <a href="#0" class="btn btn-info float-right"  data-toggle="modal" data-target="#exampleModal"><strong>+ Add campaign</strong></a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="UserDataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Target Amount</th>
                                    <th>Short description</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaings as $campaing)
                                <tr>
                                    <td><a href="#">{{ $campaing->title }}</a></td>
                                    <td>{{ $campaing->target_amount }}</td>
                                    <td>{{ $campaing->short_desc }}</td>
                                    <td>{{ Str::limit($campaing->description,30)}}</td>
                                    <td>{{ $campaing->image }}</td>

                                    <td>
                                        @if ($campaing->status == 1)
                                        <span class="badge badge-success">{{ ucfirst('active') }}</span>
                                        @elseif($campaing->status == 0)
                                        <span class="badge badge-warning">{{ ucfirst('inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>

                                        <a class=" btn  btn-primary btn-sm badge bg-info" href="{{ route('recieved',$campaing->id) }}">Mark as recieved</a>

                                        <a class="btn  btn-secondary btn-sm badge" href="javascript:void(0)">N/A</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('campaign.create') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputEmail1"  placeholder="Title" required value="{{ old('title') }}">

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Target Amount</label>
                  <input type="number" class="form-control" name="target_amount" id="exampleInputEmail1"  placeholder="Amount" required value="{{ old('target_amount') }}">

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Short Description</label>
                  <textarea  class="form-control" name="short_desc" id="exampleInputEmail1"  placeholder="Short Description" required>{{ old('short_desc') }}</textarea>

                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea  class="form-control" name="description" id="exampleInputEmail1"  placeholder=" Description" required>{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Image</label>
                  <input required type="file" class="form-control" name="image" id="exampleInputPassword1" >
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Status active</label>
                  </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>

</section>
@endsection()

@push('footer_js')
<script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function() {
        $("#UserDataTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [],
        });
    });
</script>
@endpush
