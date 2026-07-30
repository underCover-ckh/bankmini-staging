<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
  public function index()
    {
        $user = Auth::user();

        $transactions = $user->transactions()
            ->orderBy('created_at', 'desc')
            ->get(); // tambahkan get() di sini

        return view('user.transactions.index', compact('transactions', 'user'));
    }
}
