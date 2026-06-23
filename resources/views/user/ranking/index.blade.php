@extends('user.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-600 to-blue-800">

    <!-- Header & Title -->
    <div class="relative px-6 pt-8 pb-16 text-white">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-xl font-bold">SIMANTAB</h1>
            <a href="{{ route('user.complaints.create') }}"
               class="flex items-center space-x-2 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-600 rounded-full px-4 py-2 shadow-sm hover:shadow-md transition-all duration-300 border border-blue-100">
                <i class="ph ph-headset text-lg"></i>
            </a>
        </div>

        <!-- Title Section -->
        <div class="text-center mb-8">
            <p class="text-xs uppercase tracking-widest opacity-70 mb-1">Leaderboard</p>
            <h2 class="text-3xl font-bold mb-2">Ranking Menabung</h2>
            <div class="inline-flex items-center bg-white/10 px-4 py-1 rounded-full backdrop-blur-sm">
                <i class="ph ph-calendar text-sm mr-1.5 text-amber-300"></i>
                <span class="text-sm">Periode: <strong class="text-amber-300">{{ $namaBulan }}</strong></span>
            </div>
        </div>

        <!-- Premium Top Info Card -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg border border-white/10 backdrop-blur-sm hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-6 -mt-6"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center border border-white/20">
                        <i class="ph ph-gift text-2xl text-amber-300"></i>
                    </div>
                    <div>
                        <p class="text-xs opacity-80 uppercase tracking-wider">Apresiasi Bulanan</p>
                        <h3 class="text-lg font-bold">Top 10 Nasabah Terbaik</h3>
                    </div>
                </div>
                <span class="text-xs bg-amber-400 text-blue-900 font-bold px-3 py-1.5 rounded-lg shadow-sm animate-pulse">
                    Auto-Reset
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="relative z-10 px-6 -mt-8 mb-8">
        <div class="grid grid-cols-4 gap-4">
            <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-house text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Home</span>
            </a>
            <a href="{{ route('user.account') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-user text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Account</span>
            </a>
            <a href="{{ route('user.about') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-buildings text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">About</span>
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-sign-out text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Logout</span>
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <!-- Leaderboard & Rules Content Section -->
    <div class="bg-white rounded-t-3xl pt-8 pb-12 px-6 min-h-[55vh] space-y-8">
        
        <!-- Table List Container -->
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="ph ph-list-numbers text-blue-600"></i> Daftar Peringkat
                </h2>
            </div>

            <!-- Responsive Table Wrapper -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-[11px] font-bold uppercase tracking-wider">
                                <th class="py-4 px-4 w-16 text-center">Rank</th>
                                <th class="py-4 px-4">Nasabah</th>
                                <th class="py-4 px-4 text-center">Frekuensi</th>
                                <th class="py-4 px-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($rankings as $index => $rank)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <!-- Rank Badges -->
                                <td class="py-4 px-4 text-center font-bold">
                                    @if($index == 0)
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-amber-100 text-amber-600 rounded-full text-sm">🥇</span>
                                    @elseif($index == 1)
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-500 rounded-full text-sm">🥈</span>
                                    @elseif($index == 2)
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-amber-600/10 text-amber-700 rounded-full text-sm">🥉</span>
                                    @else
                                        <span class="text-gray-400 text-xs font-semibold">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                
                                <!-- Identity -->
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-800 truncate max-w-[120px] sm:max-w-none">{{ $rank->nama_siswa }}</div>
                                    <div class="text-[11px] text-gray-400 mt-0.5">{{ $rank->nomor_induk }}</div>
                                </td>
                                
                                <!-- Frequency -->
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg text-xs">
                                        {{ $rank->frekuensi_menabung }}x
                                    </span>
                                </td>
                                
                                <!-- Total Saving -->
                                <td class="py-4 px-4 text-right font-bold text-emerald-600 whitespace-nowrap">
                                    Rp{{ number_format($rank->total_nominal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="ph ph-folder-open text-gray-300 text-2xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-500">Belum ada aktivitas menabung</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rules Section (Styled Like Premium Info Block) -->
        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 space-y-3">
            <h3 class="font-bold text-gray-800 flex items-center gap-2 text-sm uppercase tracking-wider">
                <i class="ph ph-info text-blue-600 text-lg"></i> Aturan Pemeringkatan
            </h3>
            <ul class="space-y-2.5 text-xs text-gray-600">
                <li class="flex items-start gap-2">
                    <i class="ph ph-check-circle text-emerald-500 text-base shrink-0 mt-0.5"></i>
                    <span>Dihitung dari <strong class="text-gray-900">frekuensi seringnya</strong> menabung, bukan dari besarnya saldo awal.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="ph ph-check-circle text-emerald-500 text-base shrink-0 mt-0.5"></i>
                    <span>Jika frekuensi seri, pemenang ditentukan berdasarkan <strong class="text-gray-900">total nominal tabungan bulanan terbanyak</strong>.</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="ph ph-check-circle text-emerald-500 text-base shrink-0 mt-0.5"></i>
                    <span>Sistem akan mengosongkan (reset) statistik setiap <strong class="text-gray-900">awal bulan baru</strong>.</span>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection