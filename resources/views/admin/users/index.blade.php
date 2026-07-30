
@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-600">Manajemen User</h1>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            + Tambah User
        </a>
    </div>

    <!-- Form Pencarian -->
    <div class="mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" placeholder="Cari berdasarkan nama atau username..." value="{{ request('search') }}"
                class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">Username</th>
                    <th class="px-4 py-3 font-semibold">NIS</th>
                    <th class="px-4 py-3 font-semibold">Jurusan</th>
                    <th class="px-4 py-3 font-semibold">Kelas</th>
                    <th class="px-4 py-3 font-semibold">Saldo</th>
                    <th class="px-4 py-3 font-semibold">Role</th>
                    <th class="px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
    @php
        $filteredUsers = $users->filter(fn($user) => $user->role === 'user');
    @endphp

    @forelse ($filteredUsers as $user)
        <tr class="bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition">
            <td class="px-4 py-3">{{ $user->name }}</td>
            <td class="px-4 py-3">{{ $user->username }}</td>
            <td class="px-4 py-3">{{ $user->nis }}</td>
            <td class="px-4 py-3">{{ $user->jurusan }}</td>
            <td class="px-4 py-3">{{ $user->kelas }}</td>
            <td class="px-4 py-3 text-green-600 font-semibold">Rp{{ number_format($user->saldo, 2) }}</td>
            <td class="px-4 py-3">
                <span class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td class="px-4 py-3 space-x-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                Data tidak ditemukan.
            </td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>

    <div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
</div>
</div>
@endsection
</body>
</html>
