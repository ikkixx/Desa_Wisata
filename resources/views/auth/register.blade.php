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
    <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
    <!-- loader-->
    <link href="be/css/pace.min.css" rel="stylesheet" />
    <script src="be/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="be/images/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS-->
    <link href="be/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="be/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="be/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="be/css/app-style.css" rel="stylesheet" />
</head>

<body class="bg-theme bg-theme1">
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="be/images/logo-icon.png" alt="logo icon" />
                    </div>
                    <div class="card-title text-uppercase text-center py-3">
                        Sign Up
                    </div>
                    <form method="POST" action="{{ route('register-user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName" class="sr-only">Name</label>
                            <div class="position-relative has-icon-right">
                                <input
                                    type="text"
                                    name="name"
                                    id="exampleInputName"
                                    class="form-control input-shadow"
                                    placeholder="Enter Your Name" />
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmailId" class="sr-only">Email ID</label>
                            <div class="position-relative has-icon-right">
                                <input
                                    type="text"
                                    name="email"
                                    id="exampleInputEmailId"
                                    class="form-control input-shadow"
                                    placeholder="Enter Your Email ID" />
                                <div class="form-control-position">
                                    <i class="icon-envelope-open"></i>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNoHP" class="sr-only">No HP</label>
                            <div class="position-relative has-icon-right">
                                <input
                                    type="text"
                                    name="no_hp"
                                    id="exampleInputNoHP"
                                    class="form-control input-shadow"
                                    placeholder="Phone Number" />
                                <div class="form-control-position">
                                    <i class="icon-phone"></i>
                                </div>
                            </div>
                            @if ($errors->has('no_hp'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('no_hp') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input
                                    type="text"
                                    name="password"
                                    id="exampleInputPassword"
                                    class="form-control input-shadow"
                                    placeholder="Choose Password" />
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputAlamat" class="sr-only">Alamat</label>
                            <div class="position-relative has-icon-right">
                                <input
                                    type="text"
                                    name="alamat"
                                    id="exampleInputAlamat"
                                    class="form-control input-shadow"
                                    placeholder="Enter Your Address" />
                                <div class="form-control-position">
                                    <i class="icon-location-pin"></i>
                                </div>
                            </div>
                            @if ($errors->has('alamat'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Role</label>
                            <div class="position-relative has-icon-right">
                                <select class="form-select form-select-lg" id="level" name="level" placeholder="Role" required>
                                    <option selected>Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="bendahara">Bendahara</option>
                                    <option value="owner">Owner</option>
                                    <option value="pelanggan">Pelanggan</option>
                                </select>
                            </div>
                            @if ($errors->has('level'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <div class="icheck-material-white">
                                <input type="checkbox" id="user-checkbox" checked="" />
                                <label for="user-checkbox">I Agree With Terms & Conditions</label>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-light btn-block waves-effect waves-light">
                            Sign Up
                        </button>
                        <!-- <div class="text-center mt-3">Sign Up With</div>

                        <div class="form-row mt-4">
                            <div class="form-group mb-0 col-6">
                                <button type="button" class="btn btn-light btn-block">
                                    <i class="fa fa-facebook-square"></i> Facebook
                                </button>
                            </div>
                            <div class="form-group mb-0 col-6 text-right">
                                <button type="button" class="btn btn-light btn-block">
                                    <i class="fa fa-twitter-square"></i> Twitter
                                </button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">
                    Already have an account? <a href="{{route ('login')}}"> Sign In here</a>
                </p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i>
        </a>
        <!--End Back To Top Button-->

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
    <!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="be/js/jquery.min.js"></script>
    <script src="be/js/popper.min.js"></script>
    <script src="be/js/bootstrap.min.js"></script>

    <!-- sidebar-menu js -->
    <script src="be/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="be/js/app-script.js"></script>
</body>

</html>