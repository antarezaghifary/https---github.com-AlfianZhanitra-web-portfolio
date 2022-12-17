@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    @include('home.layouts.breadcrumb')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fw-medium text-uppercase text-primary mb-2">Tentang Kami</p>
                    <h1 class="display-5 mb-4">{{ profile()->nama_perusahaan }}</h1>
                    <p class="mb-4" style="text-align: justify">{{ profile()->tentang }}</p>
                    <div class="row g-4">
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fa fa-phone-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Telepon</h6>
                                    <span>{{ profile()->telepon }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fab fa-whatsapp text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Whatspp</h6>
                                    <span>{{ profile()->whatsapp }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Email</h6>
                                    <span>{{ profile()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <iframe class="w-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.97077191153!2d110.33982532348037!3d-7.803249010407266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sYogyakarta%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1671256217531!5m2!1sid!2sid"
                        frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('script')
@endsection
