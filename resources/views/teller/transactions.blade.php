@extends('teller.layout')

@section('content')
    <div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Riwayat Transaksi</h1>

        {{-- Filter, Search, Export --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            {{-- Filter Form --}}
            <form action="{{ route('teller.transactions') }}" method="GET" class="flex items-center gap-2">
                <label for="date" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal:</label>
                <input type="date" id="date" name="date" value="{{ request('date', now()->toDateString()) }}"
                    class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Filter
                </button>
            </form>

            {{-- Search Form --}}
            <form action="{{ route('teller.transactions') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari"
                    class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Cari
                </button>
            </form>

            {{-- Export Form --}}
            <form action="{{ route('teller.transactions.export') }}" method="GET" class="flex items-center gap-2">
                <input type="date" id="export_date" name="date" value="{{ request('date', now()->toDateString()) }}"
                    class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    Export to Excel
                </button>
            </form>
        </div>

        {{-- Tabel Transaksi --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="p-4">Username</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">NIS</th>
                        <th class="p-4">Deskripsi</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-300">
                            <td class="p-4">{{ $transaction->user->username }}</td>
                            <td class="p-4">{{ $transaction->user->name }}</td>
                            <td class="p-4">{{ $transaction->user->nis }}</td>
                            <td class="p-4 text-gray-600 dark:text-gray-300">{{ $transaction->description }}</td>
                            <td class="p-4 font-semibold {{ $transaction->amount > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $transaction->amount > 0 ? '+' : '-' }}Rp
                                {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">{{ $transaction->created_at->format('d M Y') }}</td>
                            <td class="p-4">
                                <button
                                    class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition duration-300"
                                    onclick="openDeleteModal({{ $transaction->id }}, '{{ $transaction->user->username }}', '{{ $transaction->description }}', '{{ number_format(abs($transaction->amount), 0, ',', '.') }}')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 dark:text-gray-400 p-6">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md shadow-xl border border-gray-100 dark:border-gray-700 transition-colors duration-200">
            <h2 class="text-lg font-bold mb-4 text-red-600 dark:text-red-400">Konfirmasi Hapus Transaksi</h2>
            <p class="mb-2 text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus transaksi berikut?</p>
            <ul class="text-sm text-gray-600 dark:text-gray-400 mb-4 space-y-1 bg-gray-50 dark:bg-gray-900/50 p-3 rounded">
                <li><strong class="text-gray-800 dark:text-gray-200">Username:</strong> <span id="modal-username"></span></li>
                <li><strong class="text-gray-800 dark:text-gray-200">Deskripsi:</strong> <span id="modal-description"></span></li>
                <li><strong class="text-gray-800 dark:text-gray-200">Jumlah:</strong> Rp <span id="modal-amount"></span></li>
            </ul>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-2">
                    <button type="button"
                        onclick="closeDeleteModal()"
                        class="bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
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
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection