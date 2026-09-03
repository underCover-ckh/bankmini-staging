<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teller = Auth::user(); // Ambil data teller yang sedang login

        // Hitung total saldo dari seluruh akun siswa/user
        $totalSaldo = User::where('role', 'user')->sum('saldo');

        // Hitung saldo/mutasi harian (transaksi hari ini)
        $dailySaldo = Transaction::whereDate('created_at', today())->sum('amount');

        // Ambil 5 riwayat transaksi terakhir + eager load relasi user (Mencegah N+1 Query)
        $transactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('teller.dashboard', compact('teller', 'totalSaldo', 'dailySaldo', 'transactions'));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        
        $sortBy = $request->input('sort', 'name'); 
        $sortOrder = strtolower($request->input('direction', 'asc')) === 'desc' ? 'desc' : 'asc';

        // Validasi kolom sorting yang diizinkan
        $allowedSorts = ['username', 'nis', 'name', 'kelas', 'saldo'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'name';
        }

        $users = User::where('role', 'user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%")
                      ->orWhere('kelas', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%")
                      ->orWhereRaw("CONCAT(kelas, ' ', jurusan) LIKE ?", ["%{$search}%"])
                      ->orWhereRaw("CONCAT(kelas, jurusan) LIKE ?", ["%{$search}%"]);
                });
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10)
            ->appends($request->all());

        return view('teller.users', compact('users', 'search', 'sortBy', 'sortOrder'));
    }
}