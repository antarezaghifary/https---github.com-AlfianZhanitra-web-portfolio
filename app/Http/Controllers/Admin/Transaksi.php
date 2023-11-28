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
        return view('admin.pages.transaksi', $results);
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
        return view('admin.pages.invoice', $results);
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
            if ($request['tgl_tersedia'] && $request['jam_selesai'] != null) {
                $date = $request['tgl_tersedia'];
                $selesai = $request['jam_selesai'];
                $tgl_tersedia = date('Y-m-d', strtotime($date));
                $jam_tersedia = date('H:i', strtotime($selesai . "+ 2 hours"));
                $status = [
                    'status' =>  $request['status_alat'],
                    'tgl_tersedia' => $tgl_tersedia,
                    'jam_tersedia' => $jam_tersedia
                ];
                TransaksiModel::where('id', $id)->update($results);
                AlatBeratModel::where('id', $id_alat_berat)->update($status);
                notify()->success('Status diperbarui', 'Berhasil');
                return back();
            } else if ($request['tgl_tersedia'] && $request['jam_selesai'] == null) {
                $date = $request['tgl_tersedia'];
                $tgl_tersedia = date('Y-m-d', strtotime($date));
                $status = [
                    'status' =>  $request['status_alat'],
                    'tgl_tersedia' => $tgl_tersedia,
                    'jam_tersedia' => null
                ];
                TransaksiModel::where('id', $id)->update($results);
                AlatBeratModel::where('id', $id_alat_berat)->update($status);
                notify()->success('Status diperbarui', 'Berhasil');
                return back();
            }
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
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'jam_selesai', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
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
        if (!empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"]) && empty($_GET["type"])) {
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
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&type=';
        } elseif (!empty($_GET["type"]) && !empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $type = $_GET["type"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('b.type', '=', $type)
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=' . $tanggal_mulai . '&tgl_sampai=' . $tanggal_sampai . '&type=' . $type;
        } elseif (!empty($_GET["type"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $type = $_GET["type"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('b.type', '=', $type)
                ->get();

            $transaksi = $getmonth;
            $url = '/download-laporan?tgl_dari=&tgl_sampai=&type=' . $type;
        } else {
            $all = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();

            $transaksi = $all;
            $url = '/download-laporan';
        }
        $type = DB::table('type')->get();
        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'type' => $type,
            'url' => $url,
        ];
        return view('admin.pages.laporan', $results);
    }

    public function cetak_laporan()
    {
        if (!empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"]) && empty($_GET["type"])) {
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
            $type = 'All';
        }

        if (!empty($_GET["type"]) && !empty($_GET["tgl_dari"]) && !empty($_GET["tgl_sampai"])) {
            $tanggal_mulai = $_GET["tgl_dari"];
            $tanggal_sampai = $_GET["tgl_sampai"];
            $type = $_GET["type"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('b.type', '=', $type)
                ->where('a.created_at', '>=', $tanggal_mulai)
                ->where('a.created_at', '<=', $tanggal_sampai)
                ->get();
            $transaksi = $getmonth;
            $periode = $tanggal_mulai . ' s.d ' . $tanggal_sampai;
            $type = $type;
        }

        if (!empty($_GET["type"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $type = $_GET["type"];
            $getmonth = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->where('b.type', '=', $type)
                ->get();
            $transaksi = $getmonth;
            $periode = 'All';
            $type = $type;
        }

        if (empty($_GET["type"]) && empty($_GET["tgl_dari"]) && empty($_GET["tgl_sampai"])) {
            $all = DB::table('transaksi as a')
                ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
                ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
                ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
                ->get();

            $transaksi = $all;
            $periode = 'All';
            $type = 'All';
        }

        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
            'periode' => $periode,
            'type' => $type,
        ];
        $pdf = Pdf::loadView('admin.pages.pdf.laporan', $results)->setPaper('a4', 'landscape');
        $name = now()->timestamp . "Laporan-" . $periode . "type-" . $type . ".pdf";
        return $pdf->download('Laporan-Transaksi' . $name);
    }
}
