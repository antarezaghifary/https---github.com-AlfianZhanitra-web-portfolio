<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Homepage extends Controller
{
    public function index()
    {

        $profile = DB::table('settings')->get()->first();
        $alat_berat = DB::table('alat_berat')->get();
        $pelanggan = DB::table('users')->where('role', 'pelanggan')->get();
        $transaksi = DB::table('transaksi as a')->where('status', '1')->get();
        $results = [
            'pagetitle' => 'Homepage',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
            'pelanggan' => $pelanggan,
            'transaksi' => $transaksi,
        ];

        return view('home.pages.homepage', $results);
    }

    public function detail($id)
    {

        $alat_berat = DB::table('alat_berat')->where('id', $id)->get()->first();
        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Detail Alat Berat',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
        ];

        return view('home.pages.detail', $results);
    }

    public function faqs()
    {

        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Tentang Kami',
            'profile' => $profile,
        ];

        return view('home.pages.about', $results);
    }

    public function cara()
    {
        $results = [
            'pagetitle' => 'Cara Pemesanan',
        ];
        return view('home.pages.faqs', $results);
    }

    public function alat_berat()
    {

        $profile = DB::table('settings')->get()->first();
        $alat_berat = DB::table('alat_berat')->get();

        $results = [
            'pagetitle' => 'Alat Berat dan Truck',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
        ];

        return view('home.pages.alat-berat', $results);
    }

    public function profile()
    {

        $profile = DB::table('settings')->get()->first();

        $results = [
            'pagetitle' => 'Profile',
            'profile' => $profile,
        ];

        return view('home.pages.profile', $results);
    }
}
