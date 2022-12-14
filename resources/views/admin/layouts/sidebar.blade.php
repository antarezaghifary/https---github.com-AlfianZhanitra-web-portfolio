<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'dashboard' ? ' ' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-booking' ? ' ' : 'collapsed' }}" href="{{ url('data-booking') }}">
                <i class="bi bi-bookmark-star"></i>
                <span>Booking dan Sewa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-alat-berat' ? ' ' : 'collapsed' }}" href="{{ url('data-alat-berat') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Data Alat Berat</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-operator' ? ' ' : 'collapsed' }}" href="{{ url('data-operator') }}">
                <i class="bi bi-person-badge"></i>
                <span>Data Operator</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $uri == 'data-laporan' ? ' ' : 'collapsed' }}" href="{{ url('data-laporan') }}">
                <i class="bi bi-list-check"></i>
                <span>Laporan</span>
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
