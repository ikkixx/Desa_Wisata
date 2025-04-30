<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>
        KiyTrip
    </title>

    <!-- range selctor slider style -->


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="fe/css/bootstrap.css" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="fe/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="fe/css/responsive.css" rel="stylesheet" />
    <!-- icon website -->
    <link rel="icon" href="fe/images/kiytrip.png" type="image/png" sizes="500x500">

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
                    <a class="navbar-brand" href="#">
                        <span>
                            KiyTrip
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home
                                        <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#bookTrip">
                                        Pesan Trip
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#package">
                                        Paket
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#service">Servis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contact_us">Kontak Kami</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('login') }}>Login</a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button
                                            type="submit">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                            <!-- <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                            </form> -->
                        </div>
                        <!-- <div class="quote_btn-container ml-0 ml-lg-4 d-flex justify-content-center">
                            <a href="">
                                Get A quote
                            </a>
                        </div> -->
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        @yield('slider')
        <!-- end slider section -->
    </div>

    <!-- trip section -->
    @yield('trip')
    <!-- end trip section -->


    <!-- package section -->
    @yield('package')
    <!-- end package section -->


    <!-- service section -->
    @yield('service')
    <!-- end service section -->

    <!-- blog section -->
    @yield('blog')
    <!-- end blog section -->

    <!-- client section -->
    @yield('client')
    <!-- end client section -->

    <!-- info section -->
    @yield('contact_us')
    <!-- end info section -->



    <script type="text/javascript" src="fe/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="fe/js/bootstrap.js"></script>

    <!-- range selector slider script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        $(".js-range-slider").ionRangeSlider({
            skin: "round",
            type: "double",
            min: 200,
            max: 10000,
            from: 200,
            to: 500,
            grid: true
        });
    </script>

</body>

</html>