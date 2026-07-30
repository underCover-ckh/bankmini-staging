<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg flex flex-col justify-between">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
    <h2 class="text-xl font-bold text-blue-600 dark:text-white">Bank Mini</h2>
     <img src="{{ asset('images/logobppi.png') }}"alt="Logo Bank Mini" class="h-10 w-auto ml-4">
</div>

                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">Dashboard</a>

                    <!-- Manajemen Akun -->
                    <div class="relative group">
                        <button type="button" onclick="toggleDropdown()"
                            class="w-full text-left px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded inline-flex justify-between items-center">
                            Manajemen Akun
                            <svg class="w-4 h-4 ml-2 transform group-hover:rotate-180 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="dropdown" class="hidden ml-4 mt-2 space-y-1">
                            <a href="{{ route('admin.users.index') }}"
                                class="block px-4 py-2 text-sm hover:bg-blue-50 dark:hover:bg-gray-700 rounded">Nasabah</a>
                            <a href="{{ route('admin.tellers.index') }}"
                                class="block px-4 py-2 text-sm hover:bg-blue-50 dark:hover:bg-gray-700 rounded">Teller</a>
                            <a href="{{ route('admin.admins.index') }}"
                                class="block px-4 py-2 text-sm hover:bg-blue-50 dark:hover:bg-gray-700 rounded">Admin</a>
                        </div>
                    </div>

                    <script>
                        function toggleDropdown() {
                            const dropdown = document.getElementById('dropdown');
                            dropdown.classList.toggle('hidden');
                        }
                    </script>

                    <!-- Pantau Transaksi -->
                    <a href="{{ route('admin.transactions') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">Pantau Transaksi</a>

                    <!-- Keluhan Nasabah -->
                    <a href="{{ route('admin.complaints') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">Keluhan Nasabah</a>
                </nav>
            </div>

            <!-- Logout -->
            <div class="p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
