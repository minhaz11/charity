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
                    <li class="breadcrumb-item active">FAQ</li>
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
                <h3 class="card-title">FAQs</h3>
                <a href="{{ url('faq/save') }}" class="btn btn-square btn-outline-primary float-right">Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Content</th>
                      <th style="width: 200px">Status</th>
                      <th style="width: 250px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                      <td>{{ $faq['title'] }}</td>
                      <td>{!! excerpt($faq['content'], 40) !!}</td>
                      <td class="text-center"><span class="badge {{ $faq['status'] == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $faq['status'] }}</span></td>
                      <td class="text-center">
                        <a href="{{ url('faq/update') . '/'  . $faq['id'] }}" class="btn btn-square btn-info text-white" title="Edit"><i class="fas fa-edit"></i></i></a>
                        <a href="{{ url('faq/delete') . '/'  . $faq['id'] }}" class="btn btn-square btn-danger text-white" title="Delete"><i class="fas fa-trash"></i></i></a>
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