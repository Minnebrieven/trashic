<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Trashic</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('private/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('private/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('private/assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('private/assets/vendors/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('private/assets/vendors/chartist/chartist.min.css') }}">
  <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('private/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('private/assets/img/logo.png')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- container scroller -->
    <div class="container-scroller">
        <!-- ======= Top Bar ======= -->
        @guest
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                @yield('content')
              </div>
              <!-- content-wrapper ends -->
        </div>
        @else
        @include('private.navbar')
        <div class="container-fluid page-body-wrapper ps-0 pe-0">
            <!-- ======= Header ======= -->
            @include('private.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('private.footer')
            </div>
        </div>
        @endguest
    </div>
    <!-- end of container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('private/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('private/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('private/assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('private/assets/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('private/assets/vendors/chartist/chartist.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('private/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('private/assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- End custom js for this page -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
