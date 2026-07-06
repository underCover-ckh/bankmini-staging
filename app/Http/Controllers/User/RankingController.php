<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function index() {
        $user = Auth::user();
    }

    public function ranking()
    {
        
        // Carbon::setTestNow('2026-08-01 10:00:00');
        $namaBulan = Carbon::now()->translatedFormat('F Y');

        // 1. Ambil data Top 10 untuk tabel utama
        $rankings = \App\Models\User::monthlySavingsRanking(10);
        
        // 2. Ambil data Top 3 untuk komponen podium di bawah saldo
        $topThree = \App\Models\User::monthlySavingsRanking(3);

        // 3. Mengambil semua data peringkat untuk mencari posisi user saat ini
        $allRankings = \App\Models\User::monthlySavingsRanking(500);

        // Mencari letak posisi user berdasarkan ID yang sedang login
        $currentUserRankIndex = $allRankings->search(function ($user) {
            return $user->id === Auth::id();
        });

        // Definisikan nilai awal default agar aman dari error undefined variable di compact()
        $actualRank = null; 
        $userTransactionCount = 0;

        // Cek jika user ditemukan di daftar peringkat
        if ($currentUserRankIndex !== false) {
            $rankPosition = $currentUserRankIndex + 1;
            
            // Simpan data peringkat HANYA jika posisi user berada di luar 10 besar
            if ($rankPosition > 10) {
                $actualRank = $rankPosition;
                $userTransactionCount = $allRankings->get($currentUserRankIndex)->monthly_transaction_count;
            }
        }

        // Kirim variabel yang dibutuhkan ke View
        return view('user.ranking.index', compact(
            'namaBulan', 
            'rankings', 
            'topThree', 
            'actualRank', 
            'userTransactionCount'
        ));
    }
}