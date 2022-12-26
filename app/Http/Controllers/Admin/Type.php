<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Type extends Controller
{
    public function index()
    {
        $type = DB::table('type')->get();
        $results = [
            'pagetitle' => 'Data Type Alat Berat',
            'uri' => 'type alat-berat',
            'type' => $type,
        ];
        return view('admin\pages\type', $results);
    }

    public function create(Request $request)
    {

        $rules =  [
            'type' => ['string', 'min:3', 'max:191', 'required', 'unique:type'],
        ];
        if ($request->validate($rules)) {
            TypeModel::insert($request->validate($rules));
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
        ];

        if ($request->validate($rules)) {
            $type = DB::table('type')->where('type', $request->type)->first();
            if ($type = NULL && $request->type != $type->type) {
                $rules = [
                    'type' => ['string', 'min:3', 'max:191', 'required', 'unique:type'],
                ];
            }else{
            $validatedData = $request->validate($rules);
            $concat = $validatedData;
            TypeModel::where('id', $id)->update($concat);

            notify()->success('Data telah diperbarui', 'Berhasil');
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
            TypeModel::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }
}
