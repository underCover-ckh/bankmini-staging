<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RankingController extends Controller
{
    public function index()
    {
        $namaBulan = Carbon::now()->translatedFormat('F Y');

        // Memanggil fungsi dari Model User
        $rankings = \App\Models\User::monthlySavingsRanking(10); 

        return view('ranking.index', compact('namaBulan', 'rankings'));
    }
}