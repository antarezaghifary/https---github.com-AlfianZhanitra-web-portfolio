<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Homepage extends Controller
{
    public function index(){

        $profile = DB::table('settings')->get()->first();
        $alat_berat = DB::table('alat_berat')->get();

        $results = [
            'pagetitle' => 'Homepage',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
        ];

        return view('home\pages\homepage', $results);
    }

    public function detail($id){

        $alat_berat = DB::table('alat_berat')->where('id', $id)->get()->first();
        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Detail Alat Berat',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
        ];

        return view('home\pages\detail', $results);
    }

    public function tentang(){

        $profile = DB::table('settings')->get()->first();
        $results = [
            'pagetitle' => 'Tentang Kami',
            'profile' => $profile,
        ];

        return view('home\pages\about', $results);
    }

    public function alat_berat(){

        $profile = DB::table('settings')->get()->first();
        $alat_berat = DB::table('alat_berat')->get();

        $results = [
            'pagetitle' => 'Alat Berat dan Truck',
            'profile' => $profile,
            'alat_berat' => $alat_berat,
        ];

        return view('home\pages\alat-berat', $results);
    }
}
