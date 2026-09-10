<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminRankingController extends Controller
{
    public function ranking()
    {
        $period = User::getCurrentRankingPeriod();
        $namaBulan = $period['label'];

        // Memanggil fungsi tanpa limit agar menampilkan seluruh siswa
        $rankings = User::monthlySavingsRanking();

        return view('admin.ranking', compact(
            'namaBulan',
            'rankings'
        ));
    }
}