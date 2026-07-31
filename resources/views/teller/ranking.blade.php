@extends('teller.layout')

@section('content')
<<<<<<< HEAD
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
=======

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Ranking Menabung Bulanan
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Periode Berjalan :
            <span class="font-semibold text-blue-600 dark:text-blue-400">
                {{ $namaBulan }}
            </span>
        </p>
    </div>

    <!-- Card Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white">
            <h2 class="flex items-center gap-2 font-semibold text-lg">
                <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                </svg>
                Apresiasi Bulanan
            </h2>
            <p class="text-3xl font-bold mt-4">Top 10 Nasabah</p>
            <p class="mt-2 text-blue-100">Daftar siswa paling aktif menabung bulan ini.</p>
        </div>

        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl shadow-lg p-6 text-white">
            <h2 class="flex items-center gap-2 font-semibold text-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sistem Reset
            </h2>
            <p class="text-3xl font-bold mt-4">Auto Reset</p>
            <p class="mt-2 text-emerald-100">Statistik otomatis kembali ke nol setiap bulan baru.</p>
        </div>
    </div>

    <!-- Tabel Ranking -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-4 flex items-center justify-center gap-2 text-gray-800 dark:text-white">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Daftar Peringkat Terbaik
        </h2>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            
            <!-- TAMPILAN DESKTOP: TABEL -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">
                            <th class="px-6 py-3 text-center w-[100px]">Rank</th>
                            <th class="px-6 py-3 text-left">Nama Siswa / Nasabah</th>
                            <th class="px-6 py-3 text-center w-[160px]">Frekuensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($rankings as $index => $rank)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50
                            @if($index == 0) bg-amber-50 dark:bg-amber-950/20 @endif">
                            <td class="px-6 py-4 text-center">
                                @if($index == 0)
                                    <span class="text-3xl">🥇</span>
                                @elseif($index == 1)
                                    <span class="text-3xl">🥈</span>
                                @elseif($index == 2)
                                    <span class="text-3xl">🥉</span>
                                @else
                                    <span class="font-bold text-gray-400 dark:text-gray-500 text-lg">#{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-900 dark:text-white text-base">
                                        {{ $rank->name }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                        NIS: {{ $rank->nis }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-bold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $rank->monthly_transaction_count }} Kali
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-16 text-center text-gray-400 dark:text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="mt-3 font-medium">Belum ada transaksi bulan ini.</p>
                                <p class="text-sm mt-1">Ajak siswa untuk mulai menabung!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- TAMPILAN MOBILE: CARD VIEW -->
            <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($rankings as $index => $rank)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition
                    @if($index == 0) bg-amber-50 dark:bg-amber-950/20 @endif">
                    <div class="flex items-start gap-3">
                        <!-- Rank -->
                        <div class="flex-shrink-0 w-10 text-center pt-1">
                            @if($index == 0)
                                <span class="text-2xl">🥇</span>
                            @elseif($index == 1)
                                <span class="text-2xl">🥈</span>
                            @elseif($index == 2)
                                <span class="text-2xl">🥉</span>
                            @else
                                <span class="font-bold text-gray-400 dark:text-gray-500">#{{ $index + 1 }}</span>
                            @endif
                        </div>
                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 dark:text-white truncate">
                                {{ $rank->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                NIS: {{ $rank->nis }}
                            </p>
                            <div class="mt-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-bold text-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $rank->monthly_transaction_count }} Kali
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-16 text-center text-gray-400 dark:text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="mt-3 font-medium">Belum ada transaksi bulan ini.</p>
                    <p class="text-sm mt-1">Ajak siswa untuk mulai menabung!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Aturan Pemeringkatan -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="font-bold mb-4 flex items-center justify-center gap-2 text-gray-800 dark:text-white">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Aturan Pemeringkatan
        </h3>
        <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Ranking dihitung berdasarkan <strong>frekuensi transaksi menabung</strong>.</span>
            </li>
            <li class="flex items-start gap-3">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Jika frekuensi sama, maka <strong>total nominal tabungan</strong> menjadi penentu.</span>
            </li>
        </ul>
    </div>

</div>

>>>>>>> master
@endsection