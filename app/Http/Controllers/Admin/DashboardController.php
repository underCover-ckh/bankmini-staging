<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    // Total transaksi bersih hari ini
    $dailyBalance = Transaction::whereDate('created_at', now())
                                ->sum('amount');

    // Total saldo aktual seluruh nasabah
    $totalBalance = User::where('role', 'user')
                        ->where('is_active', true)
                        ->sum('saldo');

    // Jumlah akun/nasabah aktif
    $activeAccounts = User::where('role', 'user')
                          ->where('is_active', true)
                          ->count();

    // Jumlah teller aktif
    $activeTellers = User::where('role', 'teller')
                         ->where('is_active', true)
                         ->count();

    // Transaksi terbaru
    $recentTransactions = Transaction::with('user')
                                     ->latest()
                                     ->take(5)
                                     ->get();

    return view('admin.dashboard', compact(
        'dailyBalance',
        'totalBalance',
        'activeAccounts',
        'activeTellers',
        'recentTransactions'
    ));
}
}
