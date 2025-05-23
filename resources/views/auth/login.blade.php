<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login kiytrip</title>
    <!-- loader-->
    <link href="be/css/pace.min.css" rel="stylesheet" />
    <script src="be/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="be/images/kiytrip.png" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="be/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="be/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="be/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="be/css/app-style.css" rel="stylesheet" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

        <div class="loader-wrapper">
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="be/images/kiytrip.png" alt="logo icon" style="width: 150px; height: auto;">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Sign In</div>
                    <form method="POST" action="{{ route('login-user') }}" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername" class="sr-only">Email</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputUsername" class="form-control input-shadow" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Enter Password" name="password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="icheck-material-white">
                                    <input type="checkbox" id="user-checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="user-checkbox">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group col-6 text-right">
                                <a href="reset-password.html">Reset Password</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light btn-block">Sign In</button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">Do not have an account? <a href="{{route('register')}}"> Sign Up here</a></p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">
                <p class="mb-0">Gaussion Texture</p>
                <hr>
                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>
                <p class="mb-0">Gradient Background</p>
                <hr>
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

    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="be/js/jquery.min.js"></script>
    <script src="be/js/popper.min.js"></script>
    <script src="be/js/bootstrap.min.js"></script>

    <!-- sidebar-menu js -->
    <script src="be/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="be/js/app-script.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Client-side validation
            $('#loginForm').on('submit', function(e) {
                const email = $('#exampleInputUsername').val().trim();
                const password = $('#exampleInputPassword').val().trim();
                let errorMessage = '';
                
                if (!email && !password) {
                    errorMessage = 'Email dan password tidak boleh kosong!';
                } else if (!email) {
                    errorMessage = 'Email tidak boleh kosong!';
                } else if (!password) {
                    errorMessage = 'Password tidak boleh kosong!';
                }
                
                if (errorMessage) {
                    e.preventDefault();
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: errorMessage,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Mengerti'
                    });
                    
                    if (!email) {
                        $('#exampleInputUsername').focus();
                    } else {
                        $('#exampleInputPassword').focus();
                    }
                }
            });

            // Check for server-side errors (like incorrect password)
            @if($errors->has('email') || $errors->has('password'))
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Email atau password salah!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Coba Lagi'
                });
                $('#exampleInputPassword').val('').focus();
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>