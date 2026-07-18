@extends('teller.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Ranking Menabung Bulanan</h1>
    <p class="text-gray-600 dark:text-gray-400">Periode Berjalan: <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $namaBulan }}</span></p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-semibold flex items-center gap-2 text-white">
            <i class="ph ph-trophy text-xl text-amber-300"></i> Apresiasi Bulanan
        </h2>
        <p class="text-3xl font-bold mt-4 text-white">Top 10 Nasabah</p>
        <p class="text-sm mt-2 text-blue-100 opacity-90">Daftar siswa paling aktif menabung bulan ini.</p>
    </div>
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-semibold flex items-center gap-2 text-white">
            <i class="ph ph-clock-counter-clockwise text-xl text-emerald-200"></i> Sistem Reset
        </h2>
        <p class="text-3xl font-bold mt-4 text-white">Auto-Reset</p>
        <p class="text-sm mt-2 text-emerald-100 opacity-90">Statistik otomatis kembali ke nol setiap bulan baru.</p>
    </div>
</div>

<div class="mb-6">
    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="ph ph-list-numbers text-xl text-blue-500"></i> Daftar Peringkat Terbaik
    </h2>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-xs font-bold uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                        <th class="py-4 px-6 w-20 text-center">Rank</th>
                        <th class="py-4 px-6">Nama Siswa / Nasabah</th>
                        <th class="py-4 px-6 text-center">Frekuensi</th>
                        <th class="py-4 px-6 text-right">Total Tabungan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                    @forelse($rankings as $index => $rank)
                    {{-- Highlight warna kuning khusus untuk Peringkat 1 --}}
                    <tr class="transition-colors duration-150 
                        @if($index == 0) 
                            bg-amber-50/80 dark:bg-amber-950/20 hover:bg-amber-100/80 dark:hover:bg-amber-900/30
                        @else 
                            hover:bg-gray-100 dark:hover:bg-gray-700/50 
                        @endif">
                                    
                        <td class="py-4 px-6 text-center font-bold">
                            @if($index == 0)
                                <span class="text-amber-600 dark:text-amber-400 font-extrabold">#1</span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500 font-semibold">#{{ $index + 1 }}</span>
                            @endif
                        </td>
                        
                        <td class="py-4 px-6">
                            <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $rank->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1 mt-0.5">
                                <i class="ph ph-identification-card opacity-70"></i> {{ $rank->nis }}
                            </div>
                        </td>
                        
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 px-3 py-1 rounded-full text-xs border border-blue-100 dark:border-blue-900/50">
                                {{ $rank->monthly_transaction_count }} Kali
                            </span>
                        </td>
                        
                        <td class="py-4 px-6 text-right font-bold text-emerald-600 dark:text-emerald-400">
                            Rp {{ number_format($rank->monthly_transaction_amount ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 px-6 text-center text-gray-400 dark:text-gray-500">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <i class="ph ph-folder-open text-3xl opacity-40"></i>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada aktivitas transaksi menabung di bulan ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 border border-gray-200 dark:border-gray-700 space-y-3 transition-colors duration-200">
    <h3 class="font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2 text-sm uppercase tracking-wider">
        <i class="ph ph-info text-blue-500 text-lg"></i> Aturan Pemeringkatan
    </h3>
    <ul class="space-y-2.5 text-sm text-gray-600 dark:text-gray-300">
        <li class="flex items-start gap-2">
            <i class="ph ph-check-circle text-emerald-500 dark:text-emerald-400 text-base shrink-0 mt-0.5"></i>
            <span>Dihitung berdasarkan <strong class="text-gray-900 dark:text-white">frekuensi (seringnya)</strong> menabung tanpa melihat jumlah saldo yang disetor.</span>
        </li>
        <li class="flex items-start gap-2">
            <i class="ph ph-check-circle text-emerald-500 dark:text-emerald-400 text-base shrink-0 mt-0.5"></i>
            <span>Jika frekuensi sama, posisi ditentukan dari <strong class="text-gray-900 dark:text-white">total nominal tabungan terbesar</strong> pada bulan tersebut.</span>
        </li>
    </ul>
</div>
@endsection