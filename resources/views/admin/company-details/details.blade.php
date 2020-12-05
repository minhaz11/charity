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
                    <li class="breadcrumb-item active">Company Details</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible bg-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! \Session::get('success') !!}
              </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Company Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('company-details/save') }}" method="post" id="company-details-form">

                  {{ csrf_field() }}

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group form-error">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($preference['name']) ? $preference['name'] : '' }}">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group form-error">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($preference['email']) ? $preference['email'] : '' }}">
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ isset($preference['phone']) ? $preference['phone'] : '' }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" name="address_1" class="form-control" value="{{ isset($preference['address_1']) ? $preference['address_1'] : '' }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" name="address_2" class="form-control" value="{{ isset($preference['address_2']) ? $preference['address_2'] : '' }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="content" rows="3" placeholder="Write a short description about your company...">{{ isset($preference['content']) ? $preference['content'] : '' }}</textarea>
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
  $('#content').summernote();
  $("#company-details-form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
              required: true,
              email: true,
            }
        },
        messages: {
            name: {
                required: "Pleae enter a name",
            },
            email: {
              required: "Please select a email",
              email: "Please enter a valid email",
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