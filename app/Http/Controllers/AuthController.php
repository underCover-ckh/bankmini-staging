<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Rate limiter key berdasarkan IP
        $key = 'login-attempt:' . $request->ip();

        // Cek apakah terlalu banyak percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'username' => 'Terlalu banyak percobaan login. Coba lagi dalam 1 menit.',
            ]);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key); // Reset hit count jika berhasil login

            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect('/admin/dashboard'),
                'teller' => redirect('/teller/dashboard'),
                'user' => redirect('/user/dashboard'),
                default => redirect('/login'),
            };
        }

        // Tambah 1 hit ke limiter (expired dalam 60 detik)
        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/login'); // Arahkan ke halaman login
    }
}
