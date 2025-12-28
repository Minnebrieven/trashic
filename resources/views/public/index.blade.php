<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Literasi Sampah</title>
  <meta content="platform jual beli sampah" name="description">
  <meta content="bank sampah" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('public/assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('public/assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  @include('public.header')
  <!-- End Header -->
  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Trashic</h3>
                    <p>
                        Kampus Merdeka X MSIB <br>
                        Tanggerang, NF Computer<br>
                        Indonesia <br><br>
                        <strong>Phone:</strong> +62 853 2676 2688<br>
                        <strong>Email:</strong> info@banksampah.com<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Link Berguna</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="home">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="menu">Sampah</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="organik">Sampah Organik</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="nonorganik">Sampah Nonorganik</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('setoran.create') }}">Setoran</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('penarikan.create') }}">Tarik Saldo</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('hadiah.list') }}">Tukar Hadiah</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/berita') }}">Berita</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Fikri</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">Mahasiswa MSIB Studi Independen</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center') }}"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('public/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('public/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('public/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('public/assets/js/main.js') }}"></script>

</body>

</html>