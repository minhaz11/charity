@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                        <h3 class="card-title"><strong>Update User</strong></h3>
                    </div>
                    <form id="UserEditForm" action="{{ url('user/edit/' . $user->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-8">

                                    <!-- First Name -->
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-3 col-form-label text-right"><strong>First Name</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="first_name" name="first_name" value="{{ $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter First Name">
                                            @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="form-group row">
                                        <label for="last_name" class="col-sm-3 col-form-label text-right"><strong>Last Name</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="last_name" name="last_name" value="{{ $user->last_name }}" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter Last Name">
                                            @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right"><strong>Email</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="text" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter a valid email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label text-right"><strong>Phone</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone number">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Assign Role -->
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-3 col-form-label text-right"><strong>Assign Role</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <select name="role" class="form-control @error('role') is-invalid @enderror select2 select2-primary" id="role" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                <option value="">Please assign a role</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $role->id == $user->roles[0]->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label text-right"><strong>Password</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="password" name="password" class="form-control @error('phone') is-invalid @enderror" id="password" placeholder="Enter new Password (min 8 characters)">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group row">
                                        <label for="password_confimation" class="col-sm-3 col-form-label text-right"><strong>Confirm Password</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <input type="password" name="password_confirmation" class="form-control" id="password_confimation" placeholder="Confirm Password (min 8 characters)">
                                        </div>
                                    </div>
                                    <!-- Status -->
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label text-right"><strong>Status</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <select name="status" class="form-control @error('status') is-invalid @enderror select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- User Photo -->
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-3 col-form-label text-right"><strong>User Photo</strong></label>
                                        <div class="col-sm-9 form-error">
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input  @error('photo') is-invalid @enderror" id="photo" accept="image/*" onchange="loadFile(event)">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                @error('photo')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if (isset($user->photo))
                                            <img id="output" height="auto" width="100" style="padding: 5px" src="{{ url('public/admin/images/uploads/users/' . $user->photo) }}">
                                            @endif()
                                            <img id="output" height="auto" width="100" style="display:none; padding: 5px" src="{{ url('assets/backend/dist/img/user.png') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('users') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-info float-right" id="userEditButton">
                                <i class="fas fa-circle-notch fa-spin loader" style="display: none;"></i>
                                <span id="userEditButtonText">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection()

@push('footer_js')

<script src="{{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $(function() {
        bsCustomFileInput.init();
    });

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.style.display = "block";
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    $(function() {
        $.validator.setDefaults({
            submitHandler: function(form) {
                $("#userEditButton").attr("disabled", true).on('click', function(e) {
                    e.preventDefault();
                });
                $(".loader").show();
                $("#userEditButtonText").text("Updating...");
                form.submit();
            }
        });
        $('#UserEditForm').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true
                },
                role: {
                    required: true
                },
                password: {
                    minlength: 8
                },
                password_confirmation: {
                    minlength : 8,
                    equalTo : "#password"
                },
                photo: {
                    extension: "png|jpg|jpeg|gif|bmp",
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name.",
                    maxlength: "First name can't be greater than 255 characters."
                },
                last_name: {
                    required: "Please enter last name.",
                    maxlength: "Last name can't be greater than 255 characters."
                },
                email: {
                    required: "Please enter an email."
                },
                role: {
                    required: "Please select a role for the new user."
                },
                photo: {
                    extension: "Please upload file in these format only (png,jpg,jpeg,gif,bmp)."
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
    });
</script>

@endpush