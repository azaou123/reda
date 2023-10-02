<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title> شركة صالح بن علي الغفيص للتقييم العقاري</title>

    <link rel="shortcut icon" href="{{ asset('/img/logo/ficon.png') }}" type="image/x-icon">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <div id="preloader"></div>
    <div class="up">
        <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
    </div>

    <!-- Start of header section
 ============================================= -->
    @include('website.layouts.header')
    <!-- End of header section
 ============================================= -->

    @yield('content')
    <!-- Start of Footer  section
 ============================================= -->
    <section id="xis-footer" class="xis-footer-section">
        <div class="container">
            <div class="xis-footer-menu-content d-flex align-items-center justify-content-between">
                <div class="footer-logo">
                    <a href="{{ route('website.home') }}"><img src="{{ asset($setting->logo_white) }}" alt=""></a>
                </div>
                <div class="footer-menu ul-li">
                    <ul>
                        <li><a href="{{ route('website.home') }}">الرئيسيه</a></li>
                                <li><a href="{{ route('website.home') }}#aboutus">من نحن</a></li>
                                <li><a href="{{ route('website.home') }}#featured">أهدافنا</a></li>
                                <li><a href="{{ route('website.home') }}#services">خدماتنا</a></li>
                                <li><a href="{{ route('website.home') }}#sponsor">عملائنا</a></li>
                                                                <li><a href="{{ route('website.contactUs') }}"> تواصل معنا </a></li>
                                                                                              <li><a href="{{ route('website.Prviacy-ploice') }}"> سياسية الخصوصية</a></li>


                    </ul>
                </div>
            </div>
            <div class="xis-footer-copyright d align-items-center">

                <div class="xis-footer-social-text ul-li pera-content text-center">
                    
                    <p>© 2023 شركة صالح بن علي الغفيص للتقييم العقاري. جميع الحقوق محفوظة.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Footer section
 ============================================= -->

    <!-- For Js Library -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/appear.js') }}"></script>
    <script src="{{ asset('/js/slick.js') }}"></script>
    <script src="{{ asset('/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('/js/odometer.js') }}"></script>
    <script src="{{ asset('/js/wow.min.js') }}"></script>
    {{-- <script src="{{ asset('/js/pagenav.js') }}"></script> --}}
    <script src="{{ asset('/js/parallax.min.js') }}"></script>
    <script src="{{ asset('/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    @yield('js')
</body>

</html>
