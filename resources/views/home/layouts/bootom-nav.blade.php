<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a href="{{ url('') }}" class="w-auto mr-2">
            <img src="{{ url('assets/admin/img/logo.png') }}" alt="" style="height: 45px;">
        </a>
        <a class="navbar-brand fs-5 m-2" href="{{ url('') }}">{{ $profile->nama }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profile" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profile">
                        <li><a class="dropdown-item" href="{{ url('profile/sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ url('profile/visi-misi') }}">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="{{ url('profile/struktur-organisasi') }}">Struktur
                                Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ url('profile/guru') }}">Guru</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="fitur" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Fitur
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="fitur">
                        <li><a class="dropdown-item" href="{{ url('fitur/kalender-kegiatan') }}">Kalender Kegiatan</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('fitur/pengumuman') }}">Pengumuman</a></li>
                        <li><a class="dropdown-item" href="{{ url('fitur/hasil-ujian') }}">Hasil Ujian</a></li>
                        <li><a class="dropdown-item" href="{{ url('fitur/modul-pembelajaran') }}">Modul
                                Pembelajaran</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="galeri" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Galeri
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="galeri">
                        <li><a class="dropdown-item" href="{{ url('galeri/foto') }}">Foto</a></li>
                        <li><a class="dropdown-item" href="{{ url('galeri/video') }}">Video</a></li>
                    </ul>
                </li>
                @if (loggin() != null)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="siswa" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="bi bi-person"></i> {{ siswa()['nama'] }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="siswa">
                            <li><a class="dropdown-item" href="{{ url('siswa/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            @if (loggin() == null)
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-brand ms-lg-3">Masuk</a>
            @endif
        </div>
    </div>
</nav>
