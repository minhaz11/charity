@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@section('main_content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add New Page</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            @if(Session::has('success'))
              <div class="alert alert-success bg-succes text-white alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! \Session::get('success') !!}
              </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Page</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('save-page') }}" method="post" id="page-save-form">

                  {{ csrf_field() }}

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Ttile</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter ...">
                        @error('title')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="custom-select" name="status">
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" rows="3" id="conent"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <a href="{{ url('pages') }}" class="btn btn-danger text-white">Cancel</a>
                    <button type="submit" class="btn btn-info float-right">Save</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('footer_js')
<script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
  $('#conent').summernote();
  $("#page-save-form").validate({
        rules: {
            title: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Pleae enter a title",
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-error').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
 });
</script>
@endpush