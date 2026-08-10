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

    <!-- Form Pencarian & Filter -->
    <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
        <form action="{{ route('admin.users.index') }}" method="GET" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex flex-wrap items-center gap-2">
                <input type="text" name="search" placeholder="Cari berdasarkan nama atau username..." value="{{ request('search') }}"
                    class="flex-1 min-w-[200px] px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                    <i class="fas fa-undo mr-1"></i> Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-blue-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <!-- Kolom Nama (Sortable) -->
                    <th class="px-4 py-3 font-semibold">
                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_order' => $sortBy == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="flex items-center gap-1 hover:text-blue-600 transition group">
                            Nama
                            <span class="text-xs">
                                @if($sortBy == 'name')
                                    {!! $sortOrder == 'asc' ? '▲' : '▼' !!}
                                @else
                                    <span class="text-gray-400 group-hover:text-gray-600">⇅</span>
                                @endif
                            </span>
                        </a>
                    </th>
                    
                    <!-- Kolom Username (Sortable) -->
                    <th class="px-4 py-3 font-semibold">
                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'username', 'sort_order' => $sortBy == 'username' && $sortOrder == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="flex items-center gap-1 hover:text-blue-600 transition group">
                            Username
                            <span class="text-xs">
                                @if($sortBy == 'username')
                                    {!! $sortOrder == 'asc' ? '▲' : '▼' !!}
                                @else
                                    <span class="text-gray-400 group-hover:text-gray-600">⇅</span>
                                @endif
                            </span>
                        </a>
                    </th>
                    
                    <!-- Kolom NIS (Sortable) -->
                    <th class="px-4 py-3 font-semibold">
                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'nis', 'sort_order' => $sortBy == 'nis' && $sortOrder == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="flex items-center gap-1 hover:text-blue-600 transition group">
                            NIS
                            <span class="text-xs">
                                @if($sortBy == 'nis')
                                    {!! $sortOrder == 'asc' ? '▲' : '▼' !!}
                                @else
                                    <span class="text-gray-400 group-hover:text-gray-600">⇅</span>
                                @endif
                            </span>
                        </a>
                    </th>
                    
                    <!-- Kolom Kelas (Sortable) -->
                    <th class="px-4 py-3 font-semibold">
                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'kelas', 'sort_order' => $sortBy == 'kelas' && $sortOrder == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="flex items-center gap-1 hover:text-blue-600 transition group">
                            Kelas
                            <span class="text-xs">
                                @if($sortBy == 'kelas')
                                    {!! $sortOrder == 'asc' ? '▲' : '▼' !!}
                                @else
                                    <span class="text-gray-400 group-hover:text-gray-600">⇅</span>
                                @endif
                            </span>
                        </a>
                    </th>
                    
                    <!-- Kolom Saldo (Sortable) -->
                    <th class="px-4 py-3 font-semibold">
                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'saldo', 'sort_order' => $sortBy == 'saldo' && $sortOrder == 'asc' ? 'desc' : 'asc'])) }}" 
                           class="flex items-center gap-1 hover:text-blue-600 transition group">
                            Saldo
                            <span class="text-xs">
                                @if($sortBy == 'saldo')
                                    {!! $sortOrder == 'asc' ? '▲' : '▼' !!}
                                @else
                                    <span class="text-gray-400 group-hover:text-gray-600">⇅</span>
                                @endif
                            </span>
                        </a>
                    </th>
                    
                    <th class="px-4 py-3 font-semibold">Role</th>
                    <th class="px-4 py-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->username }}</td>
                        <td class="px-4 py-3">{{ $user->nis }}</td>
                        <td class="px-4 py-3">{{ $user->kelas }} {{ $user->jurusan }}</td>
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