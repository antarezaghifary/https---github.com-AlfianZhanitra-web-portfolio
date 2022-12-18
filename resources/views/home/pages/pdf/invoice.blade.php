<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-size: 12px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .table,
        .td,
        .th {
            border: 1px solid black;
            text-align: center
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-success {
            color: green
        }

        .text-danger {
            color: red
        }

        .fw-bold {
            font-weight: bold
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fs-4">#INV-0{{ $invoice->id }}</h2>
            <h4>{{ profile()->nama_perusahaan }}</h4>

            <div class="pt-2">
                <table>
                    <tr>
                        <td>Nama Pemesan</td>
                        <td>: {{ $invoice->nama_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: {{ $invoice->email }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>: {{ $invoice->phone }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi Proyek</td>
                        <td>: {{ $invoice->lokasi_proyek }}</td>
                    </tr>
                    <tr>
                        <td>Tgl. Pemakaian</td>
                        <td>: {{ $invoice->tgl_pemakaian }}</td>
                    </tr>
                </table>
            </div>
            <div class="pt-4">
                @if ($invoice->bukti_pembayaran != '')
                    <p class="text-center fw-bold text-success">[LUNAS]</p>
                @else
                    <p class="text-center fw-bold text-danger">[BELUM LUNAS]</p>
                @endif
                <h4 class="card-subtitle mb-2 text-muted">Detail Pesanan</h4>
                <div class="table-responsive">
                    <table class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="th">Type</th>
                                <th class="th">Merk</th>
                                <th class="th">Harga (Rp.)</th>
                                <th class="th">Durasi (Jam/Hari)</th>
                                <th class="th">Operator</th>
                                <th class="th">BBM</th>
                                <th class="th">Total (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td">{{ $invoice->type }}</td>
                                <td class="td">{{ $invoice->merk }}</td>
                                <td class="td">{{ number_format($invoice->harga) . '/' . $invoice->per }}</td>
                                <td class="td">{{ $invoice->durasi_sewa }}</td>
                                <td class="td">{!! $invoice->operator == 'Tersedia' ? '✔' : '✕' !!}</td>
                                <td class="td">{!! $invoice->bbm == 'Tersedia' ? '✔' : '✕' !!}</td>
                                <td class="td">{{ number_format($invoice->harga * $invoice->durasi_sewa) }}</td>
                            </tr>
                            <tr>
                                <th colspan="6" class="text-end th">Total</th>
                                <th class="th"> {{ number_format($invoice->harga * $invoice->durasi_sewa) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <i>Terimakasih atas kerjasamanya</i>
            </div>
        </div>
    </div>
</body>

</html>
