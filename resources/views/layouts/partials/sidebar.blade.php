<aside class="main-sidebar elevation-4 sidebar-dark-success">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link navbar-dark">
        @if (!is_null($setting->path_image) && Storage::disk('public')->exists($setting->path_image))
            <img src="{{ Storage::disk('public')->url($setting->path_image) }}" alt="AdminLTE Logo" class="brand-image"
                style="opacity: .8">
        @else
            <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image"
                style="opacity: .8">
        @endif

        <span class="brand-text">{{ $setting->nama_aplikasi }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!is_null(auth()->user()->path_image) && Storage::disk('public')->exists(auth()->user()->path_image))
                    <img src="{{ Storage::disk('public')->url(auth()->user()->path_image) }}" class="img-circle"
                        alt="User Image">
                @else
                    <img src="{{ asset('img/man.png') }}" class="img-circle" alt="User Image">
                @endif

            </div>
            <div class="info">
                <a href="{{ route('profile.show') }}" class="d-block">{{ auth()->user()->name }}</a>
                <span class="badge badge-success">{{ auth()->user()->role->name }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('petugas'))
                    <li
                        class="nav-item {{ request()->is('kartu_keluarga*') || request()->is('penduduk*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('kartu_keluarga*') || request()->is('penduduk*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>
                                Kelola Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kartu_keluarga.index') }}"
                                    class="nav-link {{ request()->is('kartu_keluarga*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-danger nav-icon"></i>
                                    <p>Data Kartu Keluarga</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penduduk.index') }}"
                                    class="nav-link {{ request()->is('penduduk*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-success nav-icon"></i>
                                    <p>Data Penduduk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item {{ request()->is('data_kelahiran*') ||
                        request()->is('data_kematian*') ||
                        request()->is('data_pendatang*') ||
                        request()->is('data_pindah*') ||
                        request()->is('data_sktm*')
                            ? 'menu-open'
                            : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('data_kelahiran*') ||
                            request()->is('data_kematian*') ||
                            request()->is('data_pendatang*') ||
                            request()->is('data_pindah*') ||
                            request()->is('data_sktm*')
                                ? 'active'
                                : '' }}">
                            <i class="nav-icon fas fa-sync-alt"></i>
                            <p>
                                Sirkulasi Penduduk
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('data_kelahiran.index') }}"
                                    class="nav-link {{ request()->is('data_kelahiran*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-primary nav-icon"></i>
                                    <p>Data Kelahiran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data_kematian.index') }}"
                                    class="nav-link {{ request()->is('data_kematian*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-warning nav-icon"></i>
                                    <p>Data Kematian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data_pendatang.index') }}"
                                    class="nav-link {{ request()->is('data_pendatang*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-orange nav-icon"></i>
                                    <p>Data Pendatang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data_pindah.index') }}"
                                    class="nav-link {{ request()->is('data_pindah*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-purple nav-icon"></i>
                                    <p>Data Pindah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data_sktm.index') }}"
                                    class="nav-link {{ request()->is('data_sktm*') ? 'active' : '' }}">
                                    <i class="far fa-circle text-lime nav-icon"></i>
                                    <p>Data Tidak Mampu</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-header">INFORMASI</li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('pengguna.index') }}"
                            class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Pengguna
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->hasRole('petugas'))
                    <li
                        class="nav-item {{ request()->is('laporan/kartu_keluarga*') || request()->is('laporan/penduduk*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('laporan/kartu_keluarga*') || request()->is('laporan/penduduk*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('laporan.kartu_keluarga') }}"
                                    class="nav-link {{ request()->is('laporan/kartu_keluarga*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Kartu Keluarga</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.penduduk') }}"
                                    class="nav-link {{ request()->is('laporan/penduduk*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Penduduk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header">PENGUJIAN</li>

                    <li class="nav-item">
                        <a href="{{ route('pengujian.index') }}"
                            class="nav-link  {{ request()->is('pengujian*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-laptop-code"></i>
                            <p>
                                Pengujian Algoritma
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">PENGATURAN</li>

                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}"
                            class="nav-link  {{ request()->is('setting*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
