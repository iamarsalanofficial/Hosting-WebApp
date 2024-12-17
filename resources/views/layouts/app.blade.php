<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('layouts.navbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('section')

                </div>
                <!-- /.container-fluid -->
            </div>
            @include('layouts.footer')
            <<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
            <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
            <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
            <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
            @stack('script')
</body>

</html>
