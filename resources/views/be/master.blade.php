<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard KiyTrip</title>
    <!-- loader-->
    <link href="{{asset('be/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('be/js/pace.min.js')}}"></script>
    <!--favicon-->
    <link rel="icon" href="{{asset('be/images/kiytrip.png')}}" type="image/x-icon" />
    <!-- Vector CSS -->
    <link
        href="{{asset('be/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}"
        rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="{{asset('be/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <!-- <link href="{{asset('be/css/bootstrap.min.css')}}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- animate CSS-->
    <link href="{{asset('be/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset('be/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{asset('be/css/sidebar-menu.css')}}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{asset('be/css/app-style.css')}}" rel="stylesheet" />
    <!-- icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body class="bg-theme bg-theme1" id="body">
    <!-- Start wrapper-->
    <div id="wrapper">
        <!--Start sidebar-wrapper-->
        <!-- <div
            id="sidebar-wrapper"
            data-simplebar=""
            data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="/admin">
                    <img
                        src="{{asset('be/images/kiytrip.png')}}"
                        class="logo-icon"
                        alt="logo icon" />
                    <h5 class="logo-text">Dashboard KiyTrip</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header">NAVIGASI UTAMA</li>
                <li>
                    <a href="/admin">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/reservasi">
                        <i class="zmdi zmdi-calendar-note"></i> <span>Reservasi</span>
                    </a>
                </li>

                <li>
                    <a href="/pelanggan">
                        <i class="zmdi zmdi-accounts-alt"></i> <span>Pelanggan</span>
                    </a>
                </li>

                <li>
                    <a href="/users">
                        <i class="zmdi zmdi-account"></i> <span>Users</span>
                    </a>
                </li>

                <li>
                    <a href="/obyek_wisata">
                        <i class="zmdi zmdi-pin"></i> <span>Obyek Wisata</span>
                        <small class="badge float-right badge-light">New</small>
                    </a>
                </li>

                <li>
                    <a href="/paket_wisata">
                        <i class="zmdi zmdi-case"></i> <span>Paket Wisata</span>
                    </a>
                </li>

                <li>
                    <a href="/karyawan">
                        <i class="zmdi zmdi-account-box-mail"></i> <span>Karyawan</span>
                    </a>
                </li>

                <li>
                    <a href="/kategori_wisata">
                        <i class="zmdi zmdi-map"></i></i> <span>Kategori Wisata</span>
                    </a>
                </li>

                <li>
                    <a href="/berita">
                    <i class="zmdi zmdi-info"></i> <span>Berita</span>
                    </a>
                </li>

                <li>
                    <a href="/penginapan">
                        <i class="zmdi zmdi-hotel"></i> <span>Penginapan</span>
                    </a>
                </li>
            </ul>
        </div> -->
        <!--End sidebar-wrapper-->
        @yield("header")
        @yield ("sidebar")

        <!--Start topbar header-->
        <!-- <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="search-bar">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter keywords" />
                            <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a
                            class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect"
                            data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa fa-envelope-open-o"></i></a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a
                            class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect"
                            data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa fa-bell-o"></i></a>
                    </li>
                    <li class="nav-item language">
                        <a
                            class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect"
                            data-toggle="dropdown"
                            href="javascript:void();"><i class="fa fa-flag"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">
                                <i class="flag-icon flag-icon-gb mr-2"></i> English
                            </li>
                            <li class="dropdown-item">
                                <i class="flag-icon flag-icon-fr mr-2"></i> French
                            </li>
                            <li class="dropdown-item">
                                <i class="flag-icon flag-icon-cn mr-2"></i> Chinese
                            </li>
                            <li class="dropdown-item">
                                <i class="flag-icon flag-icon-de mr-2"></i> German
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                            data-toggle="dropdown"
                            href="#">
                            <span class="user-profile"><img
                                    src="https://via.placeholder.com/110x110"
                                    class="img-circle"
                                    alt="user avatar"/></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar">
                                            <img
                                                class="align-self-start mr-3"
                                                src="https://via.placeholder.com/110x110"
                                                alt="user avatar" />
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title"></h6>
                                            <p class="user-subtitle"></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="icon-envelope mr-2"></i> Inbox
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="icon-wallet mr-2"></i> Account
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="icon-settings mr-2"></i> Setting
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="icon-power mr-2"></i> Logout
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header> -->
        <!--End topbar header-->


        <!-- <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid"> -->
        <!--Start Dashboard Content-->

        <!-- <div class="card mt-3">
                    <div class="card-content">
                        <div class="row row-group m-0">
                            <div class="col-12 col-lg-6 col-xl-3 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">
                                        9526
                                        <span class="float-right"><i class="fa fa-shopping-cart"></i></span>
                                    </h5>
                                    <div class="progress my-3" style="height: 3px">
                                        <div class="progress-bar" style="width: 55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">
                                        Total Orders
                                        <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-3 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">
                                        8323
                                        <span class="float-right"><i class="fa fa-usd"></i></span>
                                    </h5>
                                    <div class="progress my-3" style="height: 3px">
                                        <div class="progress-bar" style="width: 55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">
                                        Total Revenue
                                        <span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-3 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">
                                        6200
                                        <span class="float-right"><i class="fa fa-eye"></i></span>
                                    </h5>
                                    <div class="progress my-3" style="height: 3px">
                                        <div class="progress-bar" style="width: 55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">
                                        Visitors
                                        <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-xl-3 border-light">
                                <div class="card-body">
                                    <h5 class="text-white mb-0">
                                        5630
                                        <span class="float-right"><i class="fa fa-envira"></i></span>
                                    </h5>
                                    <div class="progress my-3" style="height: 3px">
                                        <div class="progress-bar" style="width: 55%"></div>
                                    </div>
                                    <p class="mb-0 text-white small-font">
                                        Messages
                                        <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                Site Traffic
                                <div class="card-action">
                                    <div class="dropdown">
                                        <a
                                            href="javascript:void();"
                                            class="dropdown-toggle dropdown-toggle-nocaret"
                                            data-toggle="dropdown">
                                            <i class="icon-options"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void();">Action</a>
                                            <a class="dropdown-item" href="javascript:void();">Another action</a>
                                            <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <i class="fa fa-circle mr-2 text-white"></i>New Visitor
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fa fa-circle mr-2 text-light"></i>Old Visitor
                                    </li>
                                </ul>
                                <div class="chart-container-1">
                                    <canvas id="chart1"></canvas>
                                </div>
                            </div>

                            <div
                                class="row m-0 row-group text-center border-top border-light-3">
                                <div class="col-12 col-lg-4">
                                    <div class="p-3">
                                        <h5 class="mb-0">45.87M</h5>
                                        <small class="mb-0">Overall Visitor
                                            <span>
                                                <i class="fa fa-arrow-up"></i> 2.43%</span></small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="p-3">
                                        <h5 class="mb-0">15:48</h5>
                                        <small class="mb-0">Visitor Duration
                                            <span>
                                                <i class="fa fa-arrow-up"></i> 12.65%</span></small>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="p-3">
                                        <h5 class="mb-0">245.65</h5>
                                        <small class="mb-0">Pages/Visit
                                            <span>
                                                <i class="fa fa-arrow-up"></i> 5.62%</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                Weekly sales
                                <div class="card-action">
                                    <div class="dropdown">
                                        <a
                                            href="javascript:void();"
                                            class="dropdown-toggle dropdown-toggle-nocaret"
                                            data-toggle="dropdown">
                                            <i class="icon-options"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void();">Action</a>
                                            <a class="dropdown-item" href="javascript:void();">Another action</a>
                                            <a class="dropdown-item" href="javascript:void();">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void();">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container-2">
                                    <canvas id="chart2"></canvas>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-white mr-2"></i> Direct
                                            </td>
                                            <td>$5856</td>
                                            <td>+55%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-light-1 mr-2"></i>Affiliate
                                            </td>
                                            <td>$2602</td>
                                            <td>+25%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-light-2 mr-2"></i>E-mail
                                            </td>
                                            <td>$1802</td>
                                            <td>+15%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-light-3 mr-2"></i>Other
                                            </td>
                                            <td>$1105</td>
                                            <td>+5%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
        <!--End Row-->

        <!--   -->
        <!--End Row-->
        @yield("header")
        <!--End Dashboard Content-->
        @yield("content")

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i>
    </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    <!-- <footer class="footer">
        <div class="container">
            <div class="text-center">Copyright © 2018 Dashtreme Admin</div>
        </div>
    </footer> -->
    <!--End footer-->

    <!--start color switcher-->
    <div class="right-sidebar">
        <div class="switcher-icon">
            <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
        </div>
        <div class="right-sidebar-content">
            <p class="mb-0">Gaussion Texture</p>
            <hr />

            <ul class="switcher">
                <li id="theme1"></li>
                <li id="theme2"></li>
                <li id="theme3"></li>
                <li id="theme4"></li>
                <li id="theme5"></li>
                <li id="theme6"></li>
            </ul>

            <p class="mb-0">Gradient Background</p>
            <hr />

            <ul class="switcher">
                <li id="theme7"></li>
                <li id="theme8"></li>
                <li id="theme9"></li>
                <li id="theme10"></li>
                <li id="theme11"></li>
                <li id="theme12"></li>
                <li id="theme13"></li>
                <li id="theme14"></li>
                <li id="theme15"></li>
            </ul>
        </div>
    </div>
    <!--end color switcher-->
    </div>
    <!--End wrapper-->
    <!-- SweetAlert 2 -->
    <script>
        function deleteConfirm(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after confirmation
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('be/js/jquery.min.js')}}"></script>
    <script src="{{asset('be/js/popper.min.js')}}"></script>
    <script src="{{asset('be/js/bootstrap.min.js')}}"></script>
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <!-- simplebar js -->
    <script src="{{asset('be/plugins/simplebar/js/simplebar.js')}}"></script>
    <!-- sidebar-menu js -->
    <script src="{{asset('be/js/sidebar-menu.js')}}"></script>
    <!-- loader scripts -->
    <script src="{{asset('be/js/jquery.loading-indicator.js')}}"></script>
    <!-- Custom scripts -->
    <script src="{{asset('be/js/app-script.js')}}"></script>
    <!-- Chart js -->

    <script src="{{asset('be/plugins/Chart.js/Chart.min.js')}}"></script>

    <!-- Index js -->
    <script src="{{asset('be/js/index.js')}}"></script>
</body>

</html>