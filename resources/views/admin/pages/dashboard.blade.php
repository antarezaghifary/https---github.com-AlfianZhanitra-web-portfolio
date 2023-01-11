@extends('admin.layouts.template')

@section('main')
    <main id="main" class="main">

       @include('admin.layouts.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Aksi</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('user/data-pelanggan') }}">Lihat</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Pelanggan <span>| Daftar Pelanggan</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ count($pelanggan) }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Aksi</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('data-alat-berat') }}">Lihat</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Alat Berat <span>| Daftar Alat Berat</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-card-checklist"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ count($alat_berat) }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Aksi</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ url('data-transaksi') }}">Lihat</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Transaksi <span>| Daftar Transaksi</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bookmark-star"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ count($transaksi) }} </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Transaksi <span>| Daftar Transaksi</span></h5>
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Pesanan</th>
                                                    <th>Type</th>
                                                    <th>Merk</th>
                                                    <th>Total</th>
                                                    <th>Pembayaran</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi as $item)
                                                    <tr>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->type }}</td>
                                                        <td>{{ $item->merk }}</td>
                                                        <td>Rp.{{ number_format($item->harga * $item->durasi_sewa) }}</td>
                                                        <td>{!! $item->status == '0'
                                                            ? '<span class="badge bg-danger">Belum Lunas</span>'
                                                            : ($item->status != '0'
                                                                ? '<span class="badge bg-success"> Lunas </span>'
                                                                : '') !!}</td>
                                                        <td>{!! $item->status == '0'
                                                            ? '<span class="badge bg-danger"> Menunggu Konfirmasi</span>'
                                                            : ($item->status == '1'
                                                                ? '<span class="badge bg-success"> Pesanan Disetujui</span>'
                                                                : '') !!}</td>
                                                        <td>
                                                            <a href="{{ url('detail-transaksi/' . $item->id) }}" class="btn btn-sm btn-success"><i
                                                                    class="bi bi-card-list"> </i>
                                                                Detail</a>
                                                            @if ($item->status != '1')
                                                                <a href="{{ url('delete-transaksi/' . $item->id) }}" class="btn btn-sm btn-danger"><i
                                                                        class="bi bi-x"></i>
                                                                    Batalkan</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>

    </main><!-- End #main -->
@endsection
