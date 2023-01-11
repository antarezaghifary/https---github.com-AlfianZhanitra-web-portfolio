@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    @include('home.layouts.slider')

    <!-- Facts Start -->
    <div class="container-fluid facts my-5 p-5">
        <div class="row g-5">
            <div class="col-md-6 col-xl-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="text-center border p-5">
                    <i class="fa fa-cogs fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">{{ count($alat_berat) }}</h1>
                    <span class="fs-5 fw-semi-bold text-white">Alat Berat</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center border p-5">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">{{ count($pelanggan) }}</h1>
                    <span class="fs-5 fw-semi-bold text-white">Pelanggan</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 wow fadeIn" data-wow-delay="0.7s">
                <div class="text-center border p-5">
                    <i class="fa fa-check-double fa-3x text-white mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">{{ count($transaksi) }}</h1>
                    <span class="fs-5 fw-semi-bold text-white">Transaksi Selesai</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

    @include('home.layouts.alat-berat')
@endsection
@section('script')
@endsection
