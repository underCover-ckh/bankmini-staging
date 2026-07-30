@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Manajemen Teller</h2>

    <!-- Tombol Tambah Teller dan Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.tellers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            + Tambah Teller
        </a>
        <form action="{{ route('admin.tellers.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..." value="{{ request('search') }}"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Tabel Teller -->
<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-blue-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
            <tr>
                <th class="px-4 py-3 font-semibold">Nama</th>
                <th class="px-4 py-3 font-semibold">Username</th>
                <th class="px-4 py-3 font-semibold">Jurusan</th>
                <th class="px-4 py-3 font-semibold">Kelas</th>
                <th class="px-4 py-3 font-semibold">Role</th>
                <th class="px-4 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tellers as $teller)
            <tr class="bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                <td class="px-4 py-3">{{ $teller->name }}</td>
                <td class="px-4 py-3">{{ $teller->username }}</td>
                <td class="px-4 py-3">{{ $teller->jurusan }}</td>
                <td class="px-4 py-3">{{ $teller->kelas }}</td>
                <td class="px-4 py-3">
                    <span class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">
                        {{ ucfirst($teller->role) }}
                    </span>
                </td>
                <td class="px-4 py-3 space-x-2">
                    <a href="{{ route('admin.tellers.edit', $teller->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.tellers.destroy', $teller->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus teller ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                    Tidak ada teller ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <!-- Pagination -->
    <div class="mt-4">
        {{ $tellers->links('pagination::tailwind') }}
    </div>
</div>
@endsection