<!-- <header class="header_section"> -->
<div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
        <a class="navbar-brand" href="#">
            <span>
                KiyTrip
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                @php
                use Illuminate\Support\Facades\Auth;

                $authUser = Auth::user();
                $photo = asset('images/default-user.png');

                if ($authUser) {
                if ($authUser->level == 'pelanggan' && $authUser->pelanggan && $authUser->pelanggan->foto) {
                $photo = asset('storage/' . $authUser->pelanggan->foto);
                } elseif ($authUser->karyawan && $authUser->karyawan->foto) {
                $photo = asset('storage/' . $authUser->karyawan->foto);
                }
                }
                @endphp
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#penginapan">Penginapan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#obyek-wisata">Obyek Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#paket-wisata">Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact_us">Kontak Kami</a>
                    </li>

                    @if($authUser)
                    <!-- Dropdown user login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $photo }}" alt="Profile" class="rounded-circle shadow"
                                width="40" height="40" style="object-fit: cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="fas fa-user-cog me-2"> </i> {{ Auth::user()->name }} - Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"> </i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- Jika belum login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endif
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
<!-- </header> -->