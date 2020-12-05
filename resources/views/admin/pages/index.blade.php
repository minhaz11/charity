@extends('admin.layouts.app')

@push('header_css')
@endpush

@section('main_content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pages</li>
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
                <h3 class="card-title">Pages</h3>
                <a href="{{ url('store/save-store') }}" class="btn btn-square btn-outline-primary float-right">Add New Page</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Slug</th>
                      <th style="width: 200px">Status</th>
                      <th style="width: 250px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pages as $page)
                    <tr>
                      <td>{{ $page['title'] }}</td>
                      <td>{{ $page['slug'] }}</td>
                      <td class="text-center"><span class="badge {{ $page['status'] == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $page['status'] }}</span></td>
                      <td class="text-center">
                        <a href="{{ url('page') . '/' . $page['slug'] }}" class="btn btn-square btn-success text-white" title="Preview" target="_blank"><i class="far fa-eye"></i></i></a>
                        <a href="{{ url('update-page') . '/'  . $page['id'] }}" class="btn btn-square btn-info text-white" title="Edit"><i class="fas fa-edit"></i></i></a>
                        <a href="{{ url('page/delete') . '/'  . $page['id'] }}" class="btn btn-square btn-danger text-white" title="Delete"><i class="fas fa-trash"></i></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('footer_js')
@endpush