@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    @include('home.layouts.breadcrumb')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ url('assets/upload/images/alat_berat/' . $alat_berat->gambar) }}"
                        alt="">
                </div>
                <div class="col-lg-6">
                    <div class="row p-2">
                        <div class="col-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-bookmark-dash"></i>
                                    Type</label>
                                <p>{{ $alat_berat->type }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-car-front"></i>
                                    Merk</label>
                                <p>{{ $alat_berat->merk }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-shield-check"></i>
                                    Status</label>
                                <p>{!! $alat_berat->status == 'Tersedia'
                                    ? '<span class="badge bg-success">Tersedia</span>'
                                    : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-person"></i>
                                    Operator</label>
                                <p>{!! $alat_berat->operator == 'Tersedia'
                                    ? '<span class="badge bg-success">Tersedia</span>'
                                    : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-fuel-pump-fill"></i>
                                    BBM</label>
                                <p>{!! $alat_berat->bbm == 'Tersedia'
                                    ? '<span class="badge bg-success">Tersedia</span>'
                                    : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pt-1">
                                <label class="form-label fw-bold" for=""><i class="bi bi-cash"></i> Harga
                                    Sewa</label>
                                <p>Rp.{{ number_format($alat_berat->harga) . '/' }}
                                    <small>{{ $alat_berat->durasi_sewa }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 d-flex gap-3">
                        @if ($alat_berat->status == 'Tersedia')
                            <a href="{{ url('formulir-penyewaan/'. $alat_berat->id) }}" class="btn btn-primary"><i class="bi bi-cash"></i> Sewa</a>
                        @endif
                        <a href="https://wa.me/{{ profile()->whatsapp }}" class="btn btn-success"><i
                                class="bi bi-whatsapp"></i> Whatspp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
