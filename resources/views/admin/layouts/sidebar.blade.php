<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'dashboard' ? ' ' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-transaksi' ? ' ' : 'collapsed' }}" href="{{ url('data-transaksi') }}">
                <i class="bi bi-bookmark-star"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-alat-berat' ? ' ' : 'collapsed' }}" href="{{ url('data-alat-berat') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Data Alat Berat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-type' ? ' ' : 'collapsed' }}" href="{{ url('data-type') }}">
                <i class="bi bi-hash"></i>
                <span>Data Type</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-laporan' ? ' ' : 'collapsed' }}" href="{{ url('data-laporan') }}">
                <i class="bi bi-list-check"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-rekening' ? ' ' : 'collapsed' }}" href="{{ url('data-rekening') }}">
                <i class="bi bi-credit-card"></i>
                <span>Rekening</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-profil-perusahaan' ? ' ' : 'collapsed' }}" href="{{ url('data-profil-perusahaan') }}">
                <i class="bi bi-building"></i>
                <span>Profil Perusahaan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'user' ? ' ' : 'collapsed' }}" data-bs-target="#pengguna-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pengguna-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('user/data-pelanggan') }}">
                        <i class="bi bi-circle"></i><span>Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('user/data-admin') }}">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside><!-- End Sidebar-->
