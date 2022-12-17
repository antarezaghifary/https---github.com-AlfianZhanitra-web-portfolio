<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Layanan Kami</p>
            <h1 class="display-5 mb-5">Alat Berat dan Truk</h1>
        </div>
        <div class="row g-4">
            <?php $delay = ['0.1s', '0.3s', '0.5s', '0.1s', '0.3s', '0.5s']; ?>
            @foreach ($alat_berat as $item)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $delay[rand(0, 5)] }}">
                    <div class="team-item">
                        <img class="img-thumbnail" src="{{ url('assets/upload/images/alat_berat/' . $item->gambar) }}"
                            alt="" style="height: 210px;object-fit: cover;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-square bg-primary" style="width: 90px; height: 90px;">
                                <img src="{{ url('assets/admin/img/logo-white.png') }}" alt=""
                                    style="height: 50px; width: auto; ">
                            </div>
                            <div class="position-relative overflow-hidden bg-light d-flex flex-column justify-content-center w-100 ps-4"
                                style="height: 90px;">
                                <h4 style="line-height: 14px">{{ $item->merk }}</h4>
                                <span
                                    class="text-primary">Rp.{{ number_format($item->harga) . '/' }}<small>{{ $item->durasi_sewa }}</small>
                                </span>
                                <div class="d-flex gap-2">
                                    @if ($item->bbm == 'Tersedia')
                                        <span><i class="bi bi-fuel-pump-diesel"></i> BBM</span>
                                    @endif
                                    @if ($item->operator == 'Tersedia')
                                        <span><i class="bi bi-person"></i> Operator</span>
                                    @endif
                                </div>
                                <div class="team-social">
                                    @if ($item->status == 'Tersedia')
                                        <a class="btn btn-dark mx-1" href="{{ url('detail-alat-berat/'. $item->id) }}"><i class="bi bi-file-earmark-plus"></i> Pesan</a>
                                    @else
                                        <button class="btn btn-warning disabled mx-1" href="">Tidak
                                            Tersedia</button>
                                    @endif
                                    <a class="btn btn-dark mx-1" href="{{ url('detail-alat-berat/' . $item->id) }}"><i
                                            class="bi bi-info-circle"></i>
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>