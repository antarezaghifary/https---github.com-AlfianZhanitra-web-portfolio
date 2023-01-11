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
                </div>
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
