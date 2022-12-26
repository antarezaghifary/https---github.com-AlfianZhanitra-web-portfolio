<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pelanggan extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where('role', 'pelanggan')->get();

        $results = [
            'pagetitle' => 'Data user',
            'uri' => 'admin',
            'user' => $user,
        ];
        return view('admin\pages\pelanggan', $results);
    }

    public function create(Request $request)
    {
        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required'],
            'phone' => ['string', 'min:3', 'max:191', 'required'],
            'address' => ['string', 'min:3', 'max:191', 'required'],
            'password' => ['string', 'min:3', 'max:191', 'required'],
        ];

        $data = [
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'password' => bcrypt($request['password']),
        ];

        User::insert($data);
        notify()->success('Pendaftaran Berhasil, Silahkan Login', 'Berhasil');
        return redirect('login');
    }

    public function update(Request $request, $id)
    {
        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required'],
            'phone' => ['string', 'min:3', 'max:191', 'required'],
            'address' => ['string', 'min:3', 'max:191', 'required'],
        ];

        if ($request->validate($rules)) {
            $username = DB::table('users')->where('username', $request['username'])->first();
            if ($request->username != $username->username) {
                $rules = [
                    'username' => ['string', 'min:3', 'max:191', 'required', 'unique:users'],
                ];
            }
            $data = [
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => bcrypt($request['password']),
            ];
            User::where('id', $id)->update($data);

            notify()->success('Data telah diperbarui', 'Berhasil');
            return redirect('profil-pengguna');
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return redirect('profil-pengguna');
        }
    }

    public function delete($id)
    {
        if ($id != "") {
            User::where('id', $id)->delete();
            notify()->success('Data telah dihapus', 'Berhasil');
            return back();
        } else {
            notify()->warning('Harap Periksa Kembali', 'Gagal');
            return back();
        }
    }

    public function reset($id)
    {

        if ($id != '') {

            $data = [
                'password' => bcrypt('123456')
            ];

            User::where('id', $id)->update($data);
            notify()->success('Reset Password Berhasil', 'Berhasil');
            return back();
        } else {
            notify()->warning('Terjadi Kesalahan', 'Gagal');
            return back();
        }
    }
}
