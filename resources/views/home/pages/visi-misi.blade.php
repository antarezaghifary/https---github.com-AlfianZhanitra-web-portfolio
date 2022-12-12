@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    <section id="services" class="text-center" style="padding: 30px;">
        @include('home.layouts.breadcrumb')
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-2">
                    <div class="intro text-start">
                        <h3>Visi dan Misi</h3>
                    </div>
                    <div class="service">
                        <div class="intro text-start">
                            <h4>Visi</h4>
                            <p>
                                {{ $profile->visi }}
                            </p>
                        </div>
                        <div class="intro text-start">
                            <h4>Misi</h4>
                            <p>
                                {{ $profile->misi }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="intro">
                        <h3>Kepala Sekolah</h3>
                    </div>
                    <div class="row g-4">
                        <div class="service">
                            <div class="p-2">
                                <div class="d-flex align-items-center flex-column">
                                    <img src="{{ url('assets/upload/images/organisasi/' . $kepsek->foto) }}"
                                        alt="Kepala Sekolah" class="img-fluid"
                                        style="height: 265px; width: auto; border-radius: 10px">
                                    <div class="pt-4 text-center" style="line-height: 10px">
                                        <p class="fw-bold fs-5">{{ $kepsek->nama }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
