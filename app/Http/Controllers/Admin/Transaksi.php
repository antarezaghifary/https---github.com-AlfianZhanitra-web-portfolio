<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlatBeratModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaksi extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->get();

        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('admin\pages\transaksi', $results);
    }

    public function invoice($id)
    {
        $invoice = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', $id)
            ->get()->first();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
        ];
        return view('admin\pages\invoice', $results);
    }

    public function update(Request $request, $id)
    {
        $id_alat_berat = $request['id_alatberat'];

        $rules =  [
            'status' => 'required',
        ];

        if ($request->validate($rules)) {
            $results = [
                'status' => $request['status']
            ];

            $status = [
                'status' =>  $request['status_alat']
            ];

            TransaksiModel::where('id', $id)->update($results);
            AlatBeratModel::where('id', $id_alat_berat)->update($status);
            notify()->success('Status diperbarui', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            TransaksiModel::where('id', $id)->delete();
            notify()->success('Transaksi di Batalkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function download_invoice($id)
    {
        $invoice = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', $id)
            ->get()->first();
        $data = [
            'invoice' =>  $invoice
        ];
        $pdf = Pdf::loadView('home.pages.pdf.invoice', $data)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "CVMBH_INV-0" . $invoice->id . ".pdf";
        return $pdf->download($name);
    }

    public function laporan()
    {
        if (!empty($_GET["tgl_dari"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();
            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari='.$tanggal_mulai.'&tgl_sampai='.$tanggal_sampai;
        } else {
            $all = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();
            $transaksi = $all;
            $url = '/download-laporan';
        }

        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'url' => $url,
        ];
        return view('admin\pages\laporan', $results);
    }

    public function cetak_laporan()
    {
        if (!empty($_GET["tgl_dari"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();
            $transaksi = $getmonth;
            $periode = $tanggal_mulai . ' s.d ' . $tanggal_sampai;
        }
        if (empty($_GET["tgl_dari"])) {
            $all = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();
            $transaksi = $all;
            $periode = 'AllData';
        }

        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'periode' => $periode,
        ];

        $pdf = Pdf::loadView('admin.pages.pdf.laporan', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-" . $periode . ".pdf";
        return $pdf->download($name);
    }
}
