@extends('teller.layout')

@section('content')
<div class="p-4 sm:p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Riwayat Transaksi</h1>

    {{-- Filter, Search, Export --}}
    <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4 mb-6">
        {{-- Filter Tanggal --}}
        <form action="{{ route('teller.transactions') }}" method="GET" class="flex items-center gap-2 flex-wrap">
            <label for="date" class="text-sm font-semibold text-gray-700 dark:text-gray-300 whitespace-nowrap">Tanggal:</label>
            <input type="date" id="date" name="date" value="{{ request('date', now()->toDateString()) }}"
                class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Filter
            </button>
        </form>

        {{-- Search --}}
        <form action="{{ route('teller.transactions') }}" method="GET" class="flex items-center gap-2 flex-1 max-w-md">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari username atau nama..."
                class="flex-1 p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('teller.transactions') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    ✕
                </a>
            @endif
        </form>

        {{-- Export --}}
        <form action="{{ route('teller.transactions.export') }}" method="GET" class="flex items-center gap-2 flex-wrap">
            <input type="date" id="export_date" name="date" value="{{ request('date', now()->toDateString()) }}"
                class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export Excel
            </button>
        </form>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-4 py-3 w-[12%]">Username</th>
                        <th class="px-4 py-3 w-[18%]">Nama</th>
                        <th class="px-4 py-3 w-[12%]">NIS</th>
                        <th class="px-4 py-3 w-[22%]">Deskripsi</th>
                        <th class="px-4 py-3 w-[14%] text-right">Jumlah</th>
                        <th class="px-4 py-3 w-[12%] text-center">Tanggal</th>
                        <th class="px-4 py-3 w-[10%] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-200">
                            <td class="px-4 py-3 truncate max-w-[100px]" title="{{ $transaction->user->username }}">
                                {{ $transaction->user->username }}
                            </td>
                            <td class="px-4 py-3 truncate max-w-[150px]" title="{{ $transaction->user->name }}">
                                {{ $transaction->user->name }}
                            </td>
                            <td class="px-4 py-3 font-mono text-sm">{{ $transaction->user->nis }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300 break-words">
                                {{ $transaction->description }}
                            </td>
                            <td class="px-4 py-3 font-semibold text-right whitespace-nowrap 
                                {{ $transaction->amount > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $transaction->amount > 0 ? '+' : '-' }}Rp
                                {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-center whitespace-nowrap">
                                {{ $transaction->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition duration-300 text-sm font-medium"
                                    onclick="openDeleteModal({{ $transaction->id }}, '{{ $transaction->user->username }}', '{{ $transaction->description }}', '{{ number_format(abs($transaction->amount), 0, ',', '.') }}')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 dark:text-gray-400 py-12">
                                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="mt-3 font-medium">Belum ada transaksi.</p>
                                <p class="text-sm mt-1 text-gray-400 dark:text-gray-500">Belum ada transaksi yang tercatat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
        <div class="mt-6">
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    @endif
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden backdrop-blur-sm">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md mx-4 shadow-xl border border-gray-100 dark:border-gray-700 transition-colors duration-200">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-red-600 dark:text-red-400">Konfirmasi Hapus</h2>
        </div>
        
        <p class="text-gray-700 dark:text-gray-300 mb-4">Apakah Anda yakin ingin menghapus transaksi berikut?</p>
        
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 mb-4 space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 dark:text-gray-400">Username</span>
                <span class="font-medium text-gray-800 dark:text-white" id="modal-username"></span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 dark:text-gray-400">Deskripsi</span>
                <span class="font-medium text-gray-800 dark:text-white" id="modal-description"></span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 dark:text-gray-400">Jumlah</span>
                <span class="font-bold text-red-600 dark:text-red-400">Rp <span id="modal-amount"></span></span>
            </div>
        </div>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="closeDeleteModal()"
                    class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-medium">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    function openDeleteModal(id, username, description, amount) {
        document.getElementById('modal-username').textContent = username;
        document.getElementById('modal-description').textContent = description;
        document.getElementById('modal-amount').textContent = amount;
        document.getElementById('deleteForm').action = '/teller/transactions/' + id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Tutup modal dengan klik di luar
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection