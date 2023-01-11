@extends('home.layouts.template')
@section('css')
    <link rel="stylesheet" href="{{ url('assets/homepage/css/handler.css') }}">
@endsection
@section('main')
    @include('home.layouts.breadcrumb')
    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img class="img-fluid" src="{{ url('assets/upload/images/alat_berat/' . $alat_berat->gambar) }}"
                            alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="row pt-2 pb-4">
                            <div class="col-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-bookmark-dash"></i>
                                        Type</label>
                                    <p>{{ $alat_berat->type }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-car-front"></i>
                                        Merk</label>
                                    <p>{{ $alat_berat->merk }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-shield-check"></i>
                                        Status</label>
                                    <p>
                                        {!! $alat_berat->status == 'Tersedia'
                                            ? '<span class="badge bg-success">Tersedia</span>'
                                            : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                                    @if ($alat_berat->status == 'Tidak Tersedia')
                                        <small>Tersedia Kembali Tanggal <b>{{ $alat_berat->tgl_tersedia }}</b></small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-person"></i>
                                        Operator</label>
                                    <p>{!! $alat_berat->operator == 'Tersedia'
                                        ? '<span class="badge bg-success">Tersedia</span>'
                                        : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-fuel-pump-fill"></i>
                                        BBM</label>
                                    <p>{!! $alat_berat->bbm == 'Tersedia'
                                        ? '<span class="badge bg-success">Tersedia</span>'
                                        : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pt-4">
                                    <label class="form-label fw-bold" for=""><i class="bi bi-cash"></i> Harga
                                        Sewa</label>
                                    <p>Rp.{{ number_format($alat_berat->harga) . '/' }}
                                        <small>{{ $alat_berat->durasi_sewa }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pt-2 pb-2 d-flex gap-3">
                            @if (login())
                                @if ($alat_berat->status == 'Tersedia')
                                    <button class="btn btn-primary" onclick="myFunction()"><i
                                            class="bi bi-file-earmark-plus"></i> Mulai Pesan</button>
                                @endif
                            @else
                                <a href="{{ url('login') }}" class="btn btn-primary"><i class="bi bi-person"></i>
                                    Login Untuk Melakukan Pemesanan</a>
                            @endif
                            <a href="https://wa.me/{{ profile()->whatsapp }}" class="btn btn-success"><i
                                    class="bi bi-whatsapp"></i> Whatspp</a>
                        </div>
                        <form action="{{ url('confirm') }}" method="post">
                            @csrf
                            <div class="pt-2" id="kontrak" style="display: none;">
                                <hr>
                                <div class="mb-3 pt-2">
                                    <div class="d-flex justify-content-center">
                                        <h3>Formulir Penyewaan</h3>
                                    </div>
                                    <input type="hidden" value=" {{ $alat_berat->harga }}" id="harga">
                                    <input type="hidden" name="id_alat_berat" value="{{ $alat_berat->id }}">

                                    <div class="row pt-2 pb-2">
                                        <label for="tgl_pemakaian" class="col-lg-4 col-sm-4 form-label fw-bold"> <i
                                                class="bi bi-calendar3"></i> Tanggal Pemakaian</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <input type="date" name="tgl_pemakaian" id="tgl_pemakaian"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-2 pb-2">
                                        <label for="lokasi_proyek" class="col-lg-4 col-sm-4 form-label fw-bold"> <i
                                                class="bi bi-geo-alt"></i> Lokasi Proyek</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <input type="text" name="lokasi_proyek" placeholder="Masukan Lokasi"
                                                id="lokasi_proyek" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-2 pb-2">
                                        <label for="durasi_kontrak" class="col-lg-4 col-sm-4 form-label fw-bold"> <i
                                                class="bi bi-hourglass-split"></i> Durasi Sewa</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <div class="handle-counter" id="handleCounter" onclick="sum();">
                                                <button class="counter-minus btn btn-primary">-</button>
                                                <input type="text" name="durasi_sewa" id="durasi_kontrak"
                                                    class="form-control form-control-custom">
                                                <button class="counter-plus btn btn-primary">+</button>
                                                <span style="font-weight: bold; padding-left: 10px;">Jam/Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-2 pb-2">
                                        <label class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="bi bi-"></i> Durasi
                                            Sewa</label>
                                        <div class="col-lg-8 col-sm-8">
                                            <span style="font-weight: bold; font-size: x-large;">Rp <span
                                                    id="total">0</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary" id="send"><i
                                                class="bi bi-send"></i> Pesan Sekarang</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("kontrak");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $("#durasi_kontrak").change(function() {
            if ($(this).val() != "") {
                $('#send').removeAttr('disabled');
            } else {
                $('#send').attr('disabled', 'disabled');
            }
        });
    </script>

    <script src="{{ url('assets/homepage/js/handler.js') }}"></script>
    <script src="{{ url('assets/homepage/js/price.js') }}"></script>

    <script>
        $(function($) {
            var options = {
                minimum: 0,
                maximize: 10,
                onchange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: ' + e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize' + e)
                }
            }
            $('#handleCounter').handleCounter({
                maximize: 100
            })
        })

        function valChanged(d) {
            //console.log(d)
        }
    </script>
@endsection
