@extends('teller.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Semua User</h1>

    <div class="mb-6">
        <form action="{{ route('teller.users') }}" method="GET" class="flex items-center">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari berdasarkan nama atau username..." 
                value="{{ $search ?? '' }}"
                class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent flex-grow"
            >
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg transition duration-300"
            >
                Cari
            </button>
            @if($search)
                <a 
                    href="{{ route('teller.users') }}" 
                    class="ml-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white transition duration-300"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-colors duration-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="p-4">Username</th>
                    <th class="p-4">NIS</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Saldo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700/50 transition duration-300">
                        <td class="p-4">{{ $user->username }}</td>
                        <td class="p-4">{{ $user->nis }}</td>
                        <td class="p-4 text-gray-700 dark:text-gray-300">{{ $user->name }}</td>
                        <td class="p-4 font-semibold text-green-600 dark:text-green-400">
                            Rp {{ number_format($user->saldo, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 dark:text-gray-400 p-6">
                            @if($search)
                                Tidak ditemukan user dengan kata kunci "{{ $search }}"
                            @else
                                Belum ada user.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links('pagination::tailwind') }}
    </div>
</div>
@endsection