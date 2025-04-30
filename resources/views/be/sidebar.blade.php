<!--Start sidebar-wrapper-->
<div
    id="sidebar-wrapper"
    data-simplebar=""
    data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="/admin">
            <img
                src="{{ asset('be/images/kiytrip.png')}}"
                class="logo-icon"
                alt="logo icon" />
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

        <li>
            <a href="{{ Route('reservasi.index') }}">
                <i class="zmdi zmdi-calendar-note"></i> <span>Reservasi</span>
            </a>
        </li>

        <li>
            <a href="{{ Route('pelanggan.create') }}">
                <i class="zmdi zmdi-accounts-alt"></i> <span>Pelanggan</span>
            </a>
        </li>

        <li>
            <a href="{{ Route('users') }}">
                <i class="zmdi zmdi-account"></i> <span>Users</span>
            </a>
        </li>

        <li>
            <a href="{{ Route('obyek_wisata') }}">
                <i class="zmdi zmdi-pin"></i> <span>Obyek Wisata</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>

        <li>
            <a href="{{Route('paket_wisata.index')}}">
                <i class="zmdi zmdi-case"></i> <span>Paket Wisata</span>
            </a>
        </li>

        <li>
            <a href="{{Route('karyawan.index')}}">
                <i class="zmdi zmdi-account-box-mail"></i> <span>Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{Route('kategori_wisata')}}">
                <i class="zmdi zmdi-map"></i></i> <span>Kategori Wisata</span>
            </a>
        </li>

        <li>
            <a href="{{Route('berita')}}">
                <i class="zmdi zmdi-info"></i> <span>Berita</span>
            </a>
        </li>

        <li>
            <a href="{{Route('penginapan')}}">
                <i class="zmdi zmdi-hotel"></i> <span>Penginapan</span>
            </a>
        </li>
    </ul>
</div>
<!--End sidebar-wrapper-->