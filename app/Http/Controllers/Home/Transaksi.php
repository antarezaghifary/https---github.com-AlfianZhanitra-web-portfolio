<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaksi extends Controller
{
    public function index()
    {
        $id_pelanggan = login()->id;
        $transaksi = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id_pelanggan', $id_pelanggan)->get();

        $results = [
            'pagetitle' => 'Data Transaksi',
            'transaksi' => $transaksi,
        ];
        return view('home\pages\transaksi', $results);
    }

    public function invoice($id)
    {
        $id_pelanggan = login()->id;
        $invoice = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->where('a.id', $id)
            ->where('a.id_pelanggan', $id_pelanggan)->get()->first();
        $rekening = DB::table('rekening')->get();
        $results = [
            'pagetitle' => 'Invoice',
            'invoice' => $invoice,
            'rekening' => $rekening,
        ];
        return view('home\pages\invoice', $results);
    }

    public function create(Request $request)
    {
        $rules =  [
            'id_alat_berat' => ['string', 'required'],
            'tgl_pemakaian' => ['string', 'max:191', 'required'],
            'lokasi_proyek' => ['string', 'max:191', 'required'],
            'durasi_sewa' => ['string', 'max:191', 'required'],
        ];
        $request->validate($rules);
        $data = [
            'id_pelanggan' => login()->id,
            'id_alat_berat' => $request['id_alat_berat'],
            'tgl_pemakaian' => $request['tgl_pemakaian'],
            'lokasi_proyek' => $request['lokasi_proyek'],
            'durasi_sewa'   => $request['durasi_sewa'],
        ];
        TransaksiModel::insert($data);
        notify()->success('Pesanan Berhasil, Silahkan Melakukan Pembayaran', 'Berhasil');
        return redirect('transaksi');
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];

        if ($request->validate($rules)) {
            $gambar = $request['bukti_pembayaran'];
            if ($request->bukti_pembayaran != '') {
                $location = 'assets/upload/images/bukti_pembayaran/';
                $name = now()->timestamp . "_{$gambar->getClientOriginalName()}";
                $results =  [
                    'bukti_pembayaran' => $name
                ];
                $gambar->move($location, $name);
                TransaksiModel::where('id', $id)->update($results);
                notify()->success('Bukti Pembayaran Terkirim, Tunggu Konfirmasi Admin', 'Berhasil');
                return back();
            } else {
                notify()->warning('Harap Periksa Kembali', 'Gagal');
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
}
