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
                    <li class="breadcrumb-item active">Add New Store</li>
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
                <h3 class="card-title">Add New Store</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('store/save-store') }}" method="post" id="store-save-form">

                  {{ csrf_field() }}

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror required" placeholder="Enter ...">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select" name="category_id">
                          <option value="1">Books</option>
                          <option value="1">Books</option>
                          <option value="1">Books</option>
                          <option value="2">Stationary</option>
                          <option value="2">Stationary</option>
                          <option value="2">Stationary</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter ...">
                        @error('address')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Country</label>
                        <select class="custom-select" name="country">
                          <option value="1">UK</option>
                          <option value="2">Bangladesh</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>State</label>
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="Enter ...">
                        @error('state')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>City</label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter ...">
                        @error('city')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" placeholder="Enter ...">
                        @error('postal_code')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Telephone</label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Enter ...">
                        @error('telephone')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Fax</label>
                        <input type="text" name="fax" class="form-control @error('fax') is-invalid @enderror" placeholder="Enter ...">
                        @error('fax')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter ...">
                        @error('mobile')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter ...">
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Website</label>
                        <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" placeholder="Enter ...">
                        @error('website')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Opening Hour</label>
                        <input type="text" name="opening_hour" class="form-control @error('opening_hour') is-invalid @enderror" placeholder="Enter ...">
                        @error('opening_hour')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Closing Hour</label>
                        <input type="text" name="closing_hour" class="form-control @error('closing_hour') is-invalid @enderror" placeholder="Enter ...">
                        @error('closing_hour')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Enter ...">
                        @error('latitude')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Enter ...">
                        @error('longitude')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group form-error">
                        <label>External Link</label>
                        <input type="text" name="external_link" class="form-control @error('external_link') is-invalid @enderror" placeholder="Enter ...">
                        @error('external_link')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group form-error">
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
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" id="conent"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <a href="{{ url('stores') }}" class="btn btn-danger text-white">Cancel</a>
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
  $("#store-save-form").validate({
        rules: {
            name: {
                required: true,
            },
            category_id: {
                required: true,
            },
            address: {
                required: true,
            },
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