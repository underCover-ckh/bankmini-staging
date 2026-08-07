<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index() {
        $user = Auth::user();
    }

    public function ranking()
{
    $period = \App\Models\User::getCurrentRankingPeriod();

    $namaBulan = $period['label'];

    $rankings = \App\Models\User::monthlySavingsRanking(10);

    $topThree = \App\Models\User::monthlySavingsRanking(3);

    $allRankings = \App\Models\User::monthlySavingsRanking(500);

    $currentUserRankIndex = $allRankings->search(function ($user) {
        return $user->id === Auth::id();
    });

    $actualRank = null;
    $userSavingDays = 0;

    if ($currentUserRankIndex !== false) {

        $rankPosition = $currentUserRankIndex + 1;

        if ($rankPosition > 10) {

            $actualRank = $rankPosition;

            $userSavingDays = $allRankings
                ->get($currentUserRankIndex)
                ->saving_days;
        }
    }

    return view('user.ranking.index', compact(
        'namaBulan',
        'rankings',
        'topThree',
        'actualRank',
        'userSavingDays'
    ));
}
}