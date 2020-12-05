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
                    <li class="breadcrumb-item active">Donations</li>
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
                        <h3 class="card-title"><strong>All Donations</strong></h3>
                    </div>
                    <div class="card-body">
                        <table id="UserDataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $donation)
                                <tr>
                                    <td><a href="#">{{ $donation->firstname }}</a></td>
                                    <td><a href="#">{{ $donation->lastname }}</a></td>
                                    <td>{{ isset($donation->phone) ? $donation->phone : '-'}}</td>
                                    <td>{{ $donation->email }}</td>
                                    <td>{{ $donation->adress }}</td>
                                    <td>$ {{ number_format($donation->amount,2) }}</td>
                                    <td>
                                        @if ($donation->status == 1)
                                        <span class="badge badge-success">{{ ucfirst('recieved') }}</span>
                                        @elseif($donation->status == 0)
                                        <span class="badge badge-warning">{{ ucfirst('pending') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($donation->status == 0)
                                        <a class=" btn  btn-primary btn-sm badge bg-info" href="{{ route('recieved',$donation->id) }}">Mark as recieved</a>
                                        @else
                                        <a class="btn  btn-secondary btn-sm badge" href="javascript:void(0)">N/A</a>
                                        @endif
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
