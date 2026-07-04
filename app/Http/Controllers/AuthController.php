<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin()
    {
        return view('login');
    }

    // 2. Proses Validasi Akun Masuk
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    
    // UBAH BARIS INI: Lempar ke /dashboard, bukan / lagi
    return redirect('/dashboard'); 
}

        // Jika salah password / email
        return back()->with('error', 'Email atau Password yang Anda masukkan salah!');
    }

    // 3. Fungsi Keluar / Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}