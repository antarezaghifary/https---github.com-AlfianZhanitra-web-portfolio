<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    public function index(Request $request)
    {  
        $pelanggan = DB::table('users')->where('role', 'pelanggan')->get();
        $alat_berat = DB::table('alat_berat')->get();
        $transaksi = DB::table('transaksi as a')
            ->select('a.*', 'b.type', 'b.merk', 'b.harga', 'b.operator', 'b.bbm', 'b.durasi_sewa as per', 'c.name as nama_pelanggan', 'c.phone', 'c.email')
            ->join('alat_berat as b', 'a.id_alat_berat', '=', 'b.id')
            ->join('users as c', 'a.id_pelanggan', '=', 'c.id')
            ->get();

        $results = [
            'pagetitle' => 'Dashboard',
            'uri' =>  $request->segments('1'),
            'pelanggan' => $pelanggan,
            'alat_berat' => $alat_berat,
            'transaksi' => $transaksi,

        ];
        return view('admin.pages.dashboard', $results);
    }

    public function profile(Request $request)
    {
        $results = [
            'pagetitle' => 'Profile',
            'uri' =>  $request->segments('1')
        ];

        return view('admin.pages.profile', $results);
    }


    public function profile_update(Request $request, $post)
    {

        $rules =  [
            'name' => ['string', 'min:3', 'max:191', 'required'],
            'email' => ['email', 'string', 'min:3', 'max:191', 'required'],
        ];

        $username = login()->username;
        if ($request->username != $username) {
            $rules = [
                'username' => ['alpha_num', 'string', 'min:3', 'max:191', 'required', 'unique:users'],
            ];
        }

        $photo = $request['photo'];
        if ($photo != "") {
            $name = now()->timestamp . "_{$photo->getClientOriginalName()}";
            $results =  [
                'photo' => $name
            ];
            $validatedData = $request->validate($rules);
            $concat = array_merge($validatedData, $results);
            $location = 'assets/admin/images/users/';
            $photo->move($location, $name);
        } else {
            $validatedData = $request->validate($rules);
            $concat = $validatedData;
        }

        User::where('id', $post)->update($concat);
        notify()->success('Data telah diperbarui', 'Berhasil');
        return back();
    }

    public function password_update(Request $request, $post)
    {

        $rules =  [
            'oldpass' => ['string', 'min:3', 'max:191', 'required'],
            'newpass' => ['string', 'min:3', 'max:191', 'required'],
            'repass' => ['string', 'min:3', 'max:191', 'required'],
        ];

        $request->validate($rules);
        $user = Auth::user();
        $oldpass = $request['oldpass'];
        if (!Hash::check($oldpass, $user->password)) {
            notify()->error('Kata sandi salah!', 'Gagal!');
            return back();
        } else {
            if ($request['newpass'] == $request['repass']) {
                $data = [
                    'password' => bcrypt($request['newpass'])
                ];
                User::where('id', $post)->update($data);
                notify()->success('Kata sandi telah diperbarui!', 'Berhasil');
                return back();
            } else {
                notify()->warning('Kata sandi baru tidak sama!', 'Peringatan!');
                return back();
            }
        }
    }
}
