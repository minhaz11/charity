@extends('admin.layouts.app')

@push('header_css')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/OwlCarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/plugins/OwlCarousel/css/owl.theme.default.min.css') }}">
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
                    <div class="card-header bg-light">
                        <div class="owl-carousel owl-theme">
                            @foreach($bannerImages as $bannerImage)
                            <div class="item">
                                <div class="card">
                                    <img class="card-img-top" src="{{ url('public/admin/images/uploads/banners/' . $bannerImage->title) }}" alt="Card image cap" width="500">
                                    <div class="card-body">
                                        @if ($bannerImage->status == 'inactive') 
                                        <a href="{{ url('banner-image/delete/' . $bannerImage->id) }}" class="btn btn-danger "><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                        <a href="{{ url('banner-image/activate/' . $bannerImage->id) }}" data-id="{{ $bannerImage->id }}" class="btn btn-{{ $bannerImage->status == 'active' ? 'success disabled' : 'info' }} float-right banner-activate-button" id="banner-activate-button-{{$bannerImage->id}}"><i class="fas fa-circle-notch fa-spin loader-{{$bannerImage->id}}" style="display: none;"></i><span class="banner-activate-button-text-{{$bannerImage->id}}">{{ $bannerImage->status == 'active' ? 'Activated' : 'Activate' }}</span></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @if (!empty($activeBannerImage) && ($activeBannerImage->status == 'active'))
                                <img src="{{ url('public/admin/images/uploads/banners/' . $activeBannerImage->title) }}" alt="" width="100%">
                                @else
                                <img src="http://localhost/store-finder/public/frontend/images/banner/hero_4.png" alt="" width="100%">
                                @endif
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-2"></div>
                            <div>
                                <h6 class="text-muted"><b>*Dimension (1900x700) width x height will have a better user exprerience.</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="BannerImageForm" action="{{ url('banner-image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="custom-file form-error">
                                        <input type="file" name="banner_image" class="custom-file-input" id="banner_image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        @error('banner_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                <button type="submit" class="btn btn-info btn-block" id="bannerImageAddButton">
                                    <i class="fas fa-circle-notch fa-spin loader" style="display: none;"></i>
                                    <span id="bannerImageAddButtonText">Upload</span>
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection()

@push('footer_js')
<script src="{{ asset('public/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/OwlCarousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });

    $('.owl-carousel').owlCarousel({
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            },
            1500: {
                items: 5
            }
        }
    })

    $('.banner-activate-button').on('click', function() {
        let bannerImageId = $(this).data('id');
        $('#banner-activate-button-' + bannerImageId).attr('disabled', true);
        $('.loader-' + bannerImageId).show();
        $('.banner-activate-button-text-' + bannerImageId).text('Activating...');
    });


    $(function() {
        $.validator.setDefaults({
            submitHandler: function(form) {
                $("#bannerImageAddButton").attr("disabled", true).on('click', function(e) {
                    e.preventDefault();
                });
                $(".loader").show();
                $("#bannerImageAddButtonText").text("Uploading...");
                form.submit();
            }
        });
        $('#BannerImageForm').validate({
            rules: {
                banner_image: {
                    required: true,
                    extension: "png|jpg|jpeg|gif|bmp",
                }
            },
            messages: {
                banner_image: {
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