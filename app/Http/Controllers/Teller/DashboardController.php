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

        // Hitung total saldo
        $totalSaldo = Transaction::sum('amount');

        // Hitung saldo harian (transaksi hari ini)
        $dailySaldo = Transaction::whereDate('created_at', now()->toDateString())->sum('amount');

        // Ambil 5 riwayat transaksi terakhir
        $transactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();

        return view('teller.dashboard', compact('teller', 'totalSaldo', 'dailySaldo', 'transactions'));
    }

    public function users(Request $request)
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Ambil user dengan role 'user' dan filter jika ada pencarian
        $users = User::where('role', 'user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        // Kirim juga nilai search agar tetap muncul di input saat paginasi
        $users->appends(['search' => $search]);

        return view('teller.users', compact('users', 'search'));
    }

}