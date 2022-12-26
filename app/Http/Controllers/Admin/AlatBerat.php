<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\alat_berat;
use App\Models\AlatBeratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatBerat extends Controller
{
    public function index()
    {
        $alat_berat = DB::table('alat_berat')->get();
        $type = DB::table('type')->get();

        $results = [
            'pagetitle' => 'Data Alat Berat',
            'uri' => 'admin',
            'alat_berat' => $alat_berat,
            'type' => $type,
        ];
        return view('admin.pages.alat-berat', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'type' => ['string', 'min:3', 'max:191', 'required'],
            'merk' => ['string', 'min:3', 'max:191', 'required'],
            'status' => ['string', 'min:3', 'max:191', 'required'],
            'operator' => ['string', 'min:3', 'max:191', 'required'],
            'bbm' => ['string', 'min:3', 'max:191', 'required'],
            'harga' => ['string', 'min:3', 'max:191', 'required'],
            'durasi_sewa' => ['string', 'min:3', 'max:191', 'required'],
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];
        if ($request->validate($rules)) {
            $gambar = $request['gambar'];
            $results_data = $request->validate($rules);
            if ($gambar != "") {
                $name = now()->timestamp . "_{$gambar->getClientOriginalName()}";
                $results =  [
                    'gambar' => $name
                ];
                $concat = array_merge($results_data, $results);
                $location = 'assets/upload/images/alat_berat/';
                $gambar->move($location, $name);
            } else {
                $validatedData = $results_data;
                $concat = $validatedData;
            }

            AlatBeratModel::insert($concat);
            notify()->success('Data telah ditambahkan', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'type' => ['string', 'min:3', 'max:191', 'required'],
            'merk' => ['string', 'min:3', 'max:191', 'required'],
            'status' => ['string', 'min:3', 'max:191', 'required'],
            'operator' => ['string', 'min:3', 'max:191', 'required'],
            'bbm' => ['string', 'min:3', 'max:191', 'required'],
            'harga' => ['string', 'min:3', 'max:191', 'required'],
            'durasi_sewa' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $alat_berat = AlatBeratModel::find($id);
            $gambar = $request['gambar'];

            if ($request->gambar != '') {

                $location = 'assets/upload/images/alat_berat/';
                if ($alat_berat->gambar != ''  && $alat_berat->gambar != null) {
                    $file_old = $location . $alat_berat->gambar;
                    unlink($file_old);
                }
                $name = now()->timestamp . "_{$gambar->getClientOriginalName()}";
                $results =  [
                    'gambar' => $name
                ];
                $validatedData = $request->validate($rules);
                $concat = array_merge($validatedData, $results);
                $gambar->move($location, $name);
            } else {
                $validatedData = $request->validate($rules);
                $concat = $validatedData;
            }
            AlatBeratModel::where('id', $id)->update($concat);

            notify()->success('Data telah diperbarui', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            AlatBeratModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
