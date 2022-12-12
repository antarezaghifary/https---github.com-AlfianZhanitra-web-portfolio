<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Dashboard' ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Data Pengumuman' ? '' : 'collapsed' }}" href="{{ url('data-pengumuman') }}">
                <i class="bi bi-bookmark-star"></i>
                <span>Booking dan Sewa</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Data Modul Pembelajaran' ? '' : 'collapsed' }}" href="{{ url('data-modul') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Data Alat Berat</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Data Hasil Ujian' ? '' : 'collapsed' }}" href="{{ url('data-hasil-ujian') }}">
                <i class="bi bi-person-badge"></i>
                <span>Data Operator</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Struktur Organisasi' ? '' : 'collapsed' }}" href="{{ url('data-struktur-organisasi') }}">
                <i class="bi bi-list-check"></i>
                <span>Laporan</span>
            </a>
        </li><!-- End Error 404 Page Nav -->
        <li class="nav-item">
            <a class="nav-link {{ $pagetitle == 'Profil Sekolah' ? '' : 'collapsed' }}" href="{{ url('data-profil-sekolah') }}">
                <i class="bi bi-building"></i>
                <span>Profil Perusahaan</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#pengguna-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Pengguna</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pengguna-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('data-siswa') }}">
                        <i class="bi bi-circle"></i><span>Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('data-admin') }}">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
    </ul>

</aside><!-- End Sidebar-->
