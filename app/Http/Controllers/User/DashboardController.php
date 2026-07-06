<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // Carbon::setTestNow('2026-08-01 10:00:00');
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $topThree = \App\Models\User::monthlySavingsRanking(3);

        return view('user.dashboard', compact('user', 'transactions', 'topThree'));
    }
}