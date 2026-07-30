@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Riwayat Transaksi Teller</h1>

    <!-- Search Form (Lebar Penuh di Atas) -->
<form action="{{ route('admin.transactions') }}" method="GET" class="mb-6">
    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pencarian:</label>
    <div class="flex">
        <input type="text" id="search" name="search" value="{{ request('search') }}"
            placeholder="Cari nama, username, kelas, jurusan"
            class="flex-1 px-4 py-2 rounded-l-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg shadow hover:bg-blue-700 transition">
            Cari
        </button>
        
    </div>
</form>

<!-- Filter Tanggal dan Export (Dibawah Search) -->
<div class="flex flex-wrap justify-between items-center gap-4 mb-6">
    <!-- Filter Form -->
    <form action="{{ route('admin.transactions') }}" method="GET" class="flex items-center space-x-2">
        <label for="date" class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal:</label>
        <input type="date" id="date" name="date" value="{{ request('date', now()->toDateString()) }}" 
            class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            Filter
        </button>
    </form>

    <!-- Export Form -->
    <form action="{{ route('admin.transactions.export') }}" method="GET" class="flex items-center space-x-2">
        <input type="date" name="date" value="{{ request('date', now()->toDateString()) }}" 
            class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
            Export to Excel
        </button>
    </form>
</div>


    <!-- Tabel Transaksi -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3 font-semibold">Teller</th>
                    <th class="px-6 py-3 font-semibold">Nama</th>
                    <th class="px-6 py-3 font-semibold">Username</th>
                    <th class="px-6 py-3 font-semibold">NIS</th>
                    <th class="px-6 py-3 font-semibold">Deskripsi</th>
                    <th class="px-6 py-3 font-semibold">Jumlah</th>
                    <th class="px-6 py-3 font-semibold">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($transactions as $transaction)
                <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4">{{ $transaction->teller->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $transaction->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $transaction->user->username ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $transaction->user->nis ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $transaction->description }}</td>
                    <td class="px-6 py-4 font-semibold {{ $transaction->amount > 0 ? 'text-green-500' : 'text-red-500' }}">
                        {{ $transaction->amount > 0 ? '+' : '-' }}Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $transactions->links('pagination::tailwind') }}
    </div>
</div>
@endsection