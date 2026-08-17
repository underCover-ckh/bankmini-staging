@extends('admin.layout')

@section('content')
<!-- Main Content -->
<main class="flex-1 p-4 sm:p-6 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen transition-colors duration-200">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400">Dashboard Admin</h1>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-purple-600 to-purple-800 dark:from-purple-700 dark:to-purple-900 text-white p-6 rounded-xl shadow-lg border border-purple-500/20">
            <h3 class="text-sm font-medium text-purple-100">Total Saldo Harian</h3>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($dailyBalance, 0, ',', '.') }}</p>
        </div>

        <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 text-white p-6 rounded-xl shadow-lg border border-blue-500/20">
            <h3 class="text-sm font-medium text-blue-100">Total Saldo Keseluruhan</h3>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-700 dark:from-orange-600 dark:to-orange-800 text-white p-6 rounded-xl shadow-lg border border-orange-500/20">
            <h3 class="text-sm font-medium text-orange-100">Akun Aktif</h3>
            <p class="text-2xl font-bold mt-2">{{ $activeAccounts }} akun aktif</p>
        </div>

        <div class="bg-gradient-to-br from-pink-600 to-pink-800 dark:from-pink-700 dark:to-pink-900 text-white p-6 rounded-xl shadow-lg border border-pink-500/20">
            <h3 class="text-sm font-medium text-pink-100">Teller Aktif</h3>
            <p class="text-2xl font-bold mt-2">{{ $activeTellers }} teller</p>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 transition-colors duration-200">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Riwayat Transaksi Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-blue-50 dark:bg-gray-700/60 text-gray-700 dark:text-gray-200 rounded-lg">
                        <th class="px-4 py-3 font-semibold rounded-l-lg">Waktu</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Jenis</th>
                        <th class="px-4 py-3 font-semibold rounded-r-lg">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse ($recentTransactions as $transaction)
                        <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-700/40 transition duration-150 text-gray-700 dark:text-gray-300">
                            <td class="px-4 py-3.5 whitespace-nowrap">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-4 py-3.5 font-medium text-gray-900 dark:text-white">{{ $transaction->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3.5 font-medium">
                                @if($transaction->amount > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400">
                                        Setor
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400">
                                        Tarik
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 font-semibold text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 dark:text-gray-400 py-8">
                                Tidak ada transaksi terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection