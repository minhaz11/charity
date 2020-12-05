@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@section('main_content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Simple Tables</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <form id="RolePermissionUpdateForm" action="{{ url('role/edit/' . $role->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><strong>Update Role and Permissions</strong></h3>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card-body">

                                    <!-- Name -->
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9 form-error">
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ $role->name }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Display Name -->
                                    <div class="form-group row">
                                        <label for="display_name" class="col-sm-3 col-form-label">Display Name</label>
                                        <div class="col-sm-9 form-error">
                                            <input type="text" name="display_name" id="display_name" class="form-control @error('display_name') is-invalid @enderror" placeholder="Display name" value="{{ $role->display_name }}">
                                            @error('display_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9 form-error">
                                            <textarea type="text" name="description" id="description" class="form-control" placeholder="Desciption">{{ $role->description }}</textarea>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Permissins</th>
                                                <th>View</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions->chunk(4) as $permissionChunk)
                                            @php $isTrue = true @endphp
                                            <tr>
                                                @foreach($permissionChunk as $groupPermission)
                                                @if ($isTrue)
                                                <td style="width: 30%">
                                                    <H6><strong>{{ $groupPermission->group }}</strong></H6>
                                                </td>
                                                @php $isTrue = false @endphp
                                                @endif

                                                <td class="text-center">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            @if ($groupPermission->display_name != NULL)
                                                            <input type="checkbox" name="permissions[]" value="{{ $groupPermission->id }}" id="permission_{{$groupPermission->id}}" name="role" {{ in_array($groupPermission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                            <label for="permission_{{$groupPermission->id}}"></label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ url('roles') }}" type="submit" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-info float-right" id="rolePermissionUpdateButton">
                                <i class="fas fa-circle-notch fa-spin loader" style="display: none;"></i>
                                <span id="rolePermissionUpdateButtonText">Update</span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection

@push('footer_js')
<script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function(form) {
                $("#rolePermissionUpdateButton").attr("disabled", true).on('click', function(e) {
                    e.preventDefault();
                });
                $(".loader").show();
                $("#rolePermissionUpdateButtonText").text("Updating...");
                form.submit();
            }
        });
        $('#RolePermissionUpdateForm').validate({
            rules: {
                name: {
                    required: true,
                },
                display_name: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Please enter Role name",
                },
                display_name: {
                    required: "Enter a display name for the role."
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