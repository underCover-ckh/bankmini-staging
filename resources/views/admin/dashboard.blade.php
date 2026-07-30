@extends('admin.layout')

@section('content')
<!-- Main Content -->
<main class="flex-1 p-6 bg-gray-100 text-gray-800">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">Dashboard Admin</h1>

    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-sm font-medium">Total Saldo Harian</h3>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($dailyBalance, 0, ',', '.') }}</p>
            
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-sm font-medium">Total Saldo Keseluruhan</h3>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
           
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-700 text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-sm font-medium">Akun Aktif</h3>
            <p class="text-2xl font-bold mt-2">{{ $activeAccounts }} akun aktif</p>
        </div>
        <div class="bg-gradient-to-br from-pink-500 to-pink-700 text-white p-6 rounded-lg shadow-lg">
            <h3 class="text-sm font-medium">Teller Aktif</h3>
            <p class="text-2xl font-bold mt-2">{{ $activeTellers }} teller</p>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Transaksi Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Waktu</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                        <th class="px-4 py-3 text-left font-semibold">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentTransactions as $transaction)
                        <tr class="bg-white hover:bg-blue-50 transition-shadow shadow-md rounded-lg mb-3">
                            <td class="px-4 py-3">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-4 py-3">{{ $transaction->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->amount > 0 ? 'Setor' : 'Tarik' }}
                            </td>
                            <td class="px-4 py-3">Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada transaksi terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
