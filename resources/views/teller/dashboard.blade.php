@extends('teller.layout')

@section('content')
<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Teller</h1>
    <p class="text-gray-600 dark:text-gray-400">Selamat datang, {{ $teller->name }}! Berikut adalah ringkasan aktivitas Anda.</p>
</div>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6">
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold">Total Saldo</h2>
        <p class="text-4xl font-bold mt-4">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</p>
        <p class="text-sm mt-2">Total saldo dari semua transaksi.</p>
    </div>
    <div class="bg-gradient-to-r from-green-500 to-green-700 text-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold">Saldo Harian</h2>
        <p class="text-4xl font-bold mt-4">Rp {{ number_format($dailySaldo, 0, ',', '.') }}</p>
        <p class="text-sm mt-2">Total saldo dari transaksi hari ini.</p>
    </div>
</div>

<!-- Riwayat Transaksi -->
<div>
    <h2 class="text-lg font-semibold mb-4">Riwayat Transaksi Terakhir</h2>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
        @forelse ($transactions as $transaction)
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $transaction->description }}</p>
                    <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="{{ $transaction->amount > 0 ? 'text-green-500' : 'text-red-500' }} font-bold">
                    {{ $transaction->amount > 0 ? '+' : '-' }}Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Belum ada riwayat transaksi.</p>
        @endforelse
    </div>
</div>
@endsection