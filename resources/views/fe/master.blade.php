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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom styles for this template -->
    <link href="fe/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="fe/css/responsive.css" rel="stylesheet" />
    <!-- icon website -->
    <link rel="icon" href="fe/images/kiytrip.png" type="image/png" sizes="500x500">

    <style>
        .profile-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .dropdown-menu-end {
            right: 0;
            left: auto;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @yield('header')
        <!-- end header section -->
        <!-- slider section -->
        @yield('slider')
        <!-- end slider section -->
        @yield('content')
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
    <!-- <script type="text/javascript" src="fe/js/bootstrap.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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