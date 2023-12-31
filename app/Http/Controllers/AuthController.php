<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->role == 'owner') {
                return redirect()->intended('owner');
            }
        }
        $results = [
            'pagetitle' => 'Masuk | CV. MBH'
        ];
        return view('auth.login', $results);
    }

    public function register()
    {
        $results = [
            'pagetitle' => 'Masuk | CV. MBH'
        ];
        return view('auth.register', $results);
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        $kredensil = $request->only('username', 'password');
        if (Auth::attempt($kredensil)) {
            $user = Auth::user();
            if ($user->role == 'owner') {
                notify()->success('Selamat Datang di CV. Mitra Bangun Handayani', 'Berhasil');
                return redirect('dashboard');
            } elseif ($user->role == 'admin') {
                notify()->success('Selamat Datang di CV. Mitra Bangun Handayani', 'Berhasil');
                return redirect('dashboard');
            }elseif ($user->role == 'pelanggan') {
                notify()->success('Selamat Datang di CV. Mitra Bangun Handayani', 'Berhasil');
                return redirect('/');
            }
            return redirect()->back();
        }
        notify()->warning('Akun tidak terdaftar', 'Gagal');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}
