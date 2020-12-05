@extends('admin.layouts.app')

@push('header_css')
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
                    <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title"><strong>User List</strong></h3>
                        @can('add_user')
                        <a href="{{ url('user/create') }}" class="btn btn-info float-right"><strong>+ Add User</strong></a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="UserDataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td><a href="#">{{ $user->first_name }}</a></td>
                                    <td><a href="#">{{ $user->last_name }}</a></td>
                                    <td>{{ isset($user->phone) ? $user->phone : '-'}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles[0]->name }}</td>
                                    <td>
                                        @if ($user->status == 'active')
                                        <span class="badge badge-success">{{ ucfirst($user->status) }}</span>
                                        @elseif($user->status == 'inactive')
                                        <span class="badge badge-danger">{{ ucfirst($user->status) }}</span>
                                        @elseif($user->status == 'suspended')
                                        <span class="badge badge-warning">{{ ucfirst($user->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <a href="{{ url('user/edit/' .  $user->id) }}"><i class="far fa-edit"></i></a>
                                        </span>
                                        <span class="badge bg-danger">
                                            <a href="{{ url('user/delete/' . $user->id) }}"><i class="fas fa-trash-alt"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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