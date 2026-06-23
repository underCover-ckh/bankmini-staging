<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index() {
        $teller = Auth::user();
    }

    public function ranking()
    {
        $namaBulan = Carbon::now()->translatedFormat('F Y');

        // Memanggil fungsi yang sama dari Model User
        $rankings = \App\Models\User::monthlySavingsRanking(10); 

        return view('teller.ranking', compact('namaBulan', 'rankings'));
    }  
}
