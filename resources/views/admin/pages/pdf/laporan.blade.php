<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        .th,
        thead {
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
            <center>
                <h1>Laporan Data Transaksi<br>{{ profile()->nama_perusahaan }}</h1>
            </center>
            <p><b>Periode :</b> {{ $periode }}</p>
            <p><b>Type :</b> {{ $type }}</p>
            <hr>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th class="th">Nama Pelanggan</th>
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
                    @php $total = '0' @endphp
                    @foreach ($transaksi as $item)
                    @php $total += $item->harga * $item->durasi_sewa @endphp
                    <tr>
                        <td class="td">{{ $item->nama_pelanggan }}</td>
                        <td class="td">{{ $item->type }}</td>
                        <td class="td">{{ $item->merk }}</td>
                        <td class="td">{{ number_format($item->harga) . '/' . $item->per }}</td>
                        <td class="td">{{ $item->durasi_sewa }}</td>
                        <td class="td">{!! $item->operator == 'Tersedia' ? '✔' : '✕' !!}</td>
                        <td class="td">{!! $item->bbm == 'Tersedia' ? '✔' : '✕' !!}</td>
                        <td class="td">{{ number_format($item->harga * $item->durasi_sewa) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-end">Total Pendapatan</th>
                        <th>Rp.{{ number_format($total) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>