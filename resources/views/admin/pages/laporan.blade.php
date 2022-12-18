@extends('admin.layouts.template')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $pagetitle }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dahsboard</a></li>
                    <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-lg-6 d-flex gap-2 pb-4">
                            <input type="date" class="form-control" value="{{ @$_GET['tgl_dari'] }}" name="tgl_dari">
                            s.d.
                            <input type="date" class="form-control" value="{{ @$_GET['tgl_sampai'] }}" name="tgl_sampai">
                            <button class="btn btn-success"> Terapkan </button>
                        </div>
                        <div class="col-lg-6 d-flex gap-2 pb-4">
                            <a href="{{ url('data-laporan') }}" class="btn btn-warning"><i class="bi bi-arrow-clockwise"></i> Reset </a>
                            <a href="{{ url($url) }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Cetak PDF </a>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Pesanan</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Type</th>
                                                    <th>Merk</th>
                                                    <th>Total</th>
                                                    <th>Pembayaran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi as $item)
                                                    <tr>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->nama_pelanggan }}</td>
                                                        <td>{{ $item->type }}</td>
                                                        <td>{{ $item->merk }}</td>
                                                        <td>Rp.{{ number_format($item->harga * $item->durasi_sewa) }}</td>
                                                        <td>{!! $item->bukti_pembayaran == ''
                                                            ? '<span class="badge bg-danger">Belum Lunas</span>'
                                                            : ($item->status != ''
                                                                ? '<span class="badge bg-success"> Lunas </span>'
                                                                : '') !!}</td>
                                                        <td>{!! $item->status == '0'
                                                            ? '<span class="badge bg-danger"> Menunggu Konfirmasi</span>'
                                                            : ($item->status == '1'
                                                                ? '<span class="badge bg-success"> Pesanan Disetujui</span>'
                                                                : '') !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
