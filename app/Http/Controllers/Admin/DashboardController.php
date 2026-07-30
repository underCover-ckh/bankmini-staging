<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $dailyBalance = Transaction::whereDate('created_at', now())->sum('amount');
        $totalBalance = Transaction::sum('amount');
        $activeAccounts = User::where('is_active', true)->count();
        $activeTellers = User::where('role', 'teller')->where('is_active', true)->count();
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        // Kirim ke view
        return view('admin.dashboard', compact(
            'dailyBalance',
            'totalBalance',
            'activeAccounts',
            'activeTellers',
            'recentTransactions'
        ));
    }
}
