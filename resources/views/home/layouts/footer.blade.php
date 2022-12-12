<footer>
    <div class="footer-top text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <img src="{{ url('assets/admin/img/logo.png') }}" alt="" style="height: 45px; width: 45px;">
                    <h4 class="navbar-brand">{{ $profile->nama }}<span class="dot">.</span></h4>
                    <p>{{ $profile->alamat }}</p>
                    <div class="col-auto social-icons">
                        <a href="{{ $profile->facebook }}"><i class='bx bxl-facebook'></i></a>
                        <a href="{{ $profile->youtube }}"><i class='bx bxl-youtube'></i></a>
                        <a href="{{ $profile->instagram }}"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <p class="mb-0">Copyright 2022. All rights Reserved</p> Distributed By <a
            hrefs="#">Rosa Pramediawati</a>
    </div>
</footer>
