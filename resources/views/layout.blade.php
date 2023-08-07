<!DOCTYPE html>
<html lang="en">
<!-- Start head -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="{{ asset('css/sweetalerts2.css') }}">


    <link href="{{ asset('ar/css/loader.css') }}">
    <script href="{{ asset('ar/js/loader.js') }}"></script>


    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    {{--
        @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{ asset('ar/css/bootstrap.rtl.min.css') }}">
        <link href="{{ asset('ar/css/dash_1.css') }}">
        <link href="{{asset('ar/css/plugins.css') }}">

        <link href="{{ asset('ar/css/custom_dt_custom.css') }}">
        <link href="{{ asset('ar/css/dt-global_style.css') }}">
        <link href="{{ asset('ar/css/datatables.css') }}">

    @else
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @endif --}}



    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    {{-- ........................... --}}
    <!-- to add popup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- ---------------------------Curasel  -->

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Owl Carousel theme CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- --------------------------End Carusal ----------------- -->



    <!-- to swipper in js   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.css" />
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> --}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- to add all icon  -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Template Main CSS File -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- to make animation  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleProfile.css') }}" rel="stylesheet">




    <title>YallaRehlla - @yield('title')</title>



    @yield('custom-css')

    @yield('script-pop')

</head>
<!-- End head -->

<body>

    @include('sweetalert::alert')

    {{-- -------------------------------------------- --}}
    @yield('contant')
    {{-- -------------------------------------------- --}}



    <footer id="footer" class="footer">

        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>For any help !</h4>
                    <p>chat with admins </p>
                    <div class="social-links d-flex">
                        <a href="{{url('/users/AnyProfile/1')}}" class="twitter"><i class='fas fa-user-circle'></i></a>
                        <a href="{{url('/users/AnyProfile/2')}}" class="twitter"><i class='fas fa-user-circle'></i></a>
                    </div>
                </div>
            </div>
    </footer>
    <!-- End Footer -->


    <script src="{{ asset('ar/js/app.js') }}"></script>
    <script src="{{ asset('ar/js/custom.js') }}"></script>


    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        {{-- <script src="{{ asset('ar/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('ar/js/dash_1.js') }}"></script> --}}

        {{-- <script src="{{ asset('ar/js/vendors.min.js') }}"></script>
    <script src="{{ asset('ar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('ar/js/mousetrap.min.js') }}"></script>
    <script src="{{ asset('ar/js/waves.min.js') }}"></script>
    <script src="{{ asset('ar/js/datatables.js') }}"></script> --}}
    @endif


    @yield('scripts')




    <!-- to make return above  -->


    <a href="#" class="scroll-top d-flex align-items-center
          justify-content-center"><i class="fa-solid fa-arrow-up"></i></a>
    <!-- --------------------- -->
    <!-- CSS glightbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

    <!-- JavaScript -->

    <!-- ======== SwiperJS ======= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.js"></script>
    <!-- ======== SCROLL REVEAL ======= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    {{-- Map: --}}
    <script src="{{ asset('js/goglemap.js') }}" defer>
        < script >
            <
            script src =
            "https://maps.googleapis.com/maps/api/js?key={{ config('googlemap')['map_apikey'] }}&callback=initMap"
        async defer >
    </script>



    <!-- aos th make animation  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false

        });
        window.addEventListener('load', () => {
            aos_init();
        });
    </script>
</body>

</html>
