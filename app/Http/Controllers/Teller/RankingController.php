<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RankingController extends Controller
{
    public function index() {
        $teller = Auth::user();
    }

    public function ranking()
{
    //Carbon::setTestNow('01-09-2026'); // hanya untuk testing

    $period = User::getCurrentRankingPeriod();

    $namaBulan = $period['label'];

    // Teller melihat SEMUA peringkat (tanpa limit)
    $rankings = User::monthlySavingsRanking(null);

    return view('teller.ranking', compact(
        'namaBulan',
        'rankings'
    ));
} 
}
