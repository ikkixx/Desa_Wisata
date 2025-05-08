<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register Kiytrip</title>
    <!-- loader-->
    <link href="{{asset('be/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('be/js/pace.min.js')}}"></script>
    <!--favicon-->
    <link rel="icon" href="{{asset('be/images/kiytrip.png')}}" type="image/x-icon" />
    <!-- Bootstrap core CSS-->
    <link href="{{asset('be/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{asset('be/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{asset('be/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="{{asset('be/css/app-style.css')}}" rel="stylesheet" />
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
        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="{{asset('be/images/kiytrip.png')}}" alt="logo icon" style="width: 150px; height: auto;">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">
                        Sign Up
                    </div>
                    <form method="POST" action="{{ route('register-user') }}" id="registerForm">
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
                                    type="password"
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
                                    <option value="" selected disabled>Select Role</option>
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
                                <input type="checkbox" id="user-checkbox" required />
                                <label for="user-checkbox">I Agree With Terms & Conditions</label>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-light btn-block waves-effect waves-light">
                            Sign Up
                        </button>
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
    <script src="{{asset('be/js/jquery.min.js')}}"></script>
    <script src="{{asset('be/js/popper.min.js')}}"></script>
    <script src="{{asset('be/js/bootstrap.min.js')}}"></script>

    <!-- sidebar-menu js -->
    <script src="{{asset('be/js/sidebar-menu.js')}}"></script>

    <!-- Custom scripts -->
    <script src="{{asset('be/js/app-script.js')}}"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                // Get all input values
                const name = $('#exampleInputName').val().trim();
                const email = $('#exampleInputEmailId').val().trim();
                const no_hp = $('#exampleInputNoHP').val().trim();
                const password = $('#exampleInputPassword').val().trim();
                const alamat = $('#exampleInputAlamat').val().trim();
                const level = $('#level').val();
                const termsChecked = $('#user-checkbox').is(':checked');
                
                let errorMessage = '';
                let emptyFields = [];
                
                // Check each field
                if (!name) emptyFields.push('Nama');
                if (!email) emptyFields.push('Email');
                if (!no_hp) emptyFields.push('Nomor HP');
                if (!password) emptyFields.push('Password');
                if (!alamat) emptyFields.push('Alamat');
                if (!level) emptyFields.push('Role');
                if (!termsChecked) emptyFields.push('Persetujuan Syarat & Ketentuan');
                
                // Prepare error message
                if (emptyFields.length > 0) {
                    if (emptyFields.length === 1) {
                        errorMessage = 'Field ' + emptyFields[0] + ' tidak boleh kosong!';
                    } else if (emptyFields.length === 7) {
                        errorMessage = 'Semua field tidak boleh kosong!';
                    } else {
                        errorMessage = 'Field berikut tidak boleh kosong: ' + emptyFields.join(', ');
                    }
                }
                
                // Show error if any
                if (errorMessage) {
                    e.preventDefault();
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: errorMessage,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Mengerti'
                    });
                    
                    // Focus on first empty field
                    if (!name) $('#exampleInputName').focus();
                    else if (!email) $('#exampleInputEmailId').focus();
                    else if (!no_hp) $('#exampleInputNoHP').focus();
                    else if (!password) $('#exampleInputPassword').focus();
                    else if (!alamat) $('#exampleInputAlamat').focus();
                    else if (!level) $('#level').focus();
                    else if (!termsChecked) $('#user-checkbox').focus();
                }
                
                // If all valid, form will submit normally
            });
        });
    </script>
</body>
</html>