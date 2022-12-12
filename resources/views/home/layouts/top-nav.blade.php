<div class="top-nav" id="home">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">
                <p> <i class='bx bxs-envelope'></i> {{ $profile->email }}</p>
                <p> <i class='bx bxs-phone-call'></i> {{ $profile->no_telp }}</p>
            </div>
            <div class="col-auto social-icons">
                <a href="{{ $profile->facebook }}"><i class='bx bxl-facebook'></i></a>
                <a href="{{ $profile->youtube }}"><i class='bx bxl-youtube'></i></a>
                <a href="{{ $profile->instagram }}"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </div>
</div>
