<header class="topbar-nav">
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
            @if(session('loginId'))
            <?php
            // Ambil data pengguna berdasarkan ID yang ada di session
            $user = \App\Models\User::find(session('loginId'));
            ?>
            <li class="nav-item">
                @php
                $photo = null;
                if ($user->level == 'pelanggan' && $user->pelanggan && $user->pelanggan->foto) {
                $photo = asset('storage/' . $user->pelanggan->foto);
                } elseif ($user->karyawan && $user->karyawan->foto) {
                $photo = asset('storage/' . $user->karyawan->foto);
                } else {
                $photo = asset('images/default-user.png');
                }
                @endphp

                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <img src="{{ $photo }}" alt="Profile" class="rounded-circle border" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar">
                                    <img
                                        class="align-self-start mr-3"
                                        src="{{ $photo }}"
                                        alt="user avatar" />
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{ $user->name }}</h6>
                                    <p class="user-subtitle">{{ $user->email }}</p>
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
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-light btn-block waves-effect waves-light">
                                Logout
                            </button>
                        </form>

                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
</header>