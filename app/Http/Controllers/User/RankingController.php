<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index() {
        $user = Auth()->user();
    }

    public function ranking()
    {
        $namaBulan = Carbon::now()->translatedFormat('F Y');

        // Memanggil fungsi dari Model User
        $rankings = \App\Models\User::monthlySavingsRanking(10); 

        return view('user.ranking.index', compact('namaBulan', 'rankings'));
    }
}