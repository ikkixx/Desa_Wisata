<!--Start sidebar-wrapper-->
<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="/admin">
            <img src="{{ asset('be/images/kiytrip.png')}}" class="logo-icon" alt="logo icon" />
            <h5 class="logo-text">Dashboard KiyTrip</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">NAVIGASI UTAMA</li>
        <li>
            <a href="{{ Route('admin') }}">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        @if (str_contains(Auth::user()->level, 'admin'))
        <li>
            <a href="{{ Route('user.manage') }}">
                <i class="zmdi zmdi-account"></i> <span>Users</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="zmdi zmdi-info"></i> <span>Berita</span>
            </a>
        </li>
        <li>
            <a href="{{ Route('obyek_wisata.manage') }}">
                <i class="zmdi zmdi-pin"></i> <span>Obyek Wisata</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>
        <li>
            <a href="{{ route('penginapan.manage') }}">
                <i class="zmdi zmdi-hotel"></i> <span>Penginapan</span>
            </a>
        </li>
        @elseif (str_contains(Auth::user()->level, 'bendahara'))
        <li>
            <a href="{{ Route('paket_wisata.manage') }}">
                <i class="zmdi zmdi-case"></i> <span>Paket Wisata</span>
            </a>
        </li>
        <li>
            <a href="{{ Route('reservasi.manage') }}">
                <i class="zmdi zmdi-calendar-note"></i> <span>Reservasi</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="zmdi zmdi-map"></i> <span>Kategori Wisata</span>
            </a>
        </li>
        @else
        <li>
            <a href="{{ Route('paket_wisata.manage') }}">
                <i class="zmdi zmdi-case"></i> <span>Paket Wisata</span>
            </a>
        </li>
        <li>
            <a href="{{ Route('reservasi.manage') }}">
                <i class="zmdi zmdi-calendar-note"></i> <span>Reservasi</span>
            </a>
        </li>
        <li>
            <a href="">
                <i class="zmdi zmdi-map"></i> <span>Kategori Wisata</span>
            </a>
        </li>
        <li>
            <a href="{{ Route('obyek_wisata.manage') }}">
                <i class="zmdi zmdi-pin"></i> <span>Obyek Wisata</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>
        @endif
    </ul>
</div>
<!--End sidebar-wrapper-->