@extends('teller.layout')

@section('content')
<div class="p-4 sm:p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Semua User</h1>

    <!-- Form Pencarian -->
    <div class="mb-6">
        <form action="{{ route('teller.users') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <!-- Simpan nilai sort saat mencari agar filter tidak hilang -->
            <input type="hidden" name="sort" value="{{ request('sort', 'name') }}">
            <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">

            <div class="flex flex-1 max-w-full sm:max-w-md">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari berdasarkan nama atau username..." 
                    value="{{ $search ?? '' }}"
                    class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent flex-1 min-w-0"
                >
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg transition duration-300"
                >
                    Cari
                </button>
            </div>
            @if($search)
                <a 
                    href="{{ route('teller.users', ['sort' => request('sort', 'name'), 'direction' => request('direction', 'asc')]) }}" 
                    class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white transition duration-300 text-center px-3 py-1"
                >
                    ✕ Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Desktop & Mobile Container -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
        
        @php
            $currentSort = request('sort', 'name'); // Default sort berdasarkan nama
            $currentDirection = request('direction', 'asc'); // Default urutan A-Z (asc)

            // Helper untuk membuat URL sorting
            $getSortUrl = function($column) use ($currentSort, $currentDirection) {
                $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
                return route('teller.users', array_merge(request()->query(), [
                    'sort' => $column,
                    'direction' => $newDirection
                ]));
            };
        @endphp

        <!-- Tabel Desktop -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[750px]">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                        <th class="px-4 py-3 w-[15%]">
                            <a href="{{ $getSortUrl('username') }}" class="flex items-center gap-1 hover:underline focus:outline-none">
                                Username
                                @if($currentSort === 'username')
                                    <span>{{ $currentDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 w-[15%]">
                            <a href="{{ $getSortUrl('nis') }}" class="flex items-center gap-1 hover:underline focus:outline-none">
                                NIS
                                @if($currentSort === 'nis')
                                    <span>{{ $currentDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 w-[30%]">
                            <a href="{{ $getSortUrl('name') }}" class="flex items-center gap-1 hover:underline focus:outline-none font-bold">
                                Nama
                                @if($currentSort === 'name')
                                    <span>{{ $currentDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 w-[15%]">
                            <a href="{{ $getSortUrl('kelas') }}" class="flex items-center gap-1 hover:underline focus:outline-none">
                                Kelas
                                @if($currentSort === 'kelas')
                                    <span>{{ $currentDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 w-[25%] text-right">
                            <a href="{{ $getSortUrl('saldo') }}" class="flex items-center justify-end gap-1 hover:underline focus:outline-none">
                                Saldo
                                @if($currentSort === 'saldo')
                                    <span>{{ $currentDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-200">
                            <td class="px-4 py-3 truncate max-w-[120px]" title="{{ $user->username }}">
                                {{ $user->username }}
                            </td>
                            <td class="px-4 py-3 font-mono text-sm">{{ $user->nis }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300 break-words" title="{{ $user->name }}">
                                {{ ucwords(strtolower($user->name)) }}
                            </td>
                            <td class="px-4 py-3 font-mono text-sm text-gray-600 dark:text-gray-300">
                                {{ strtoupper($user->kelas) }} {{ strtoupper($user->jurusan) }}
                            </td>
                            <td class="px-4 py-3 font-semibold text-green-600 dark:text-green-400 text-right whitespace-nowrap">
                                Rp {{ number_format($user->saldo, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 dark:text-gray-400 py-8">
                                @if($search)
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span>Tidak ditemukan user dengan kata kunci "<strong>{{ $search }}</strong>"</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                        </svg>
                                        <span>Belum ada user terdaftar.</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Card View Mobile -->
        <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($users as $user)
                <div class="p-4 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 dark:text-white truncate" title="{{ $user->name }}">
                                {{ ucwords(strtolower($user->name)) }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                @ {{ $user->username }}
                            </p>
                            <div class="flex flex-wrap gap-x-3 gap-y-1 mt-1 text-xs text-gray-500 dark:text-gray-400 font-mono">
                                <span>NIS: {{ $user->nis }}</span>
                                <span>•</span>
                                <span>Kelas: {{ strtoupper($user->kelas) }} {{ strtoupper($user->jurusan) }}</span>
                            </div>
                        </div>
                        <div class="ml-3 flex-shrink-0">
                            <p class="font-semibold text-green-600 dark:text-green-400 whitespace-nowrap">
                                Rp {{ number_format($user->saldo, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                    @if($search)
                        Tidak ditemukan user dengan kata kunci "{{ $search }}"
                    @else
                        Belum ada user terdaftar.
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="mt-6">
            {{ $users->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection