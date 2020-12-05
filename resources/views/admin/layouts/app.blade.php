<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('admin.layouts.partials.header_styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('admin.layouts.partials.nav_bar')

        @include('admin.layouts.partials.side_bar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('main_content')
        </div>
        <!-- /.content-wrapper -->
    </div>

    @include('admin.layouts.partials.footer_scripts')
    <script src="{{asset('public/js/sweetalert.js')}}"></script>
    @include('alert.success')
    @include('alert.error')
    @include('alert.errors')
</body>

</html>
