<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex flex-col lg:flex-row bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen">

    <!-- Sidebar -->
    <aside class="w-full lg:w-64 bg-white dark:bg-gray-800 shadow-lg flex flex-col justify-between min-h-screen overflow-y-auto">
        <div class="p-6">
                           <div class="flex items-center justify-between mb-8">
    <h2 class="text-xl font-bold text-blue-600 dark:text-white">Bank Mini</h2>
     <img src="{{ asset('images/logobppi.png') }}"alt="Logo Bank Mini" class="h-10 w-auto ml-4">
</div>

            <!-- Identitas Teller -->
            <div class="mb-6 p-4 bg-blue-50 dark:bg-gray-700 rounded shadow">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">Teller:</p>
                <p class="text-lg font-bold text-blue-600 dark:text-white">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ Auth::user()->email }}</p>
            </div>

            <nav class="space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('teller.dashboard') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>

                <!-- Debit -->
                <a href="{{ route('teller.debit') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-arrow-down mr-2"></i> Debit
                </a>

                <!-- Kredit -->
                <a href="{{ route('teller.credit') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-arrow-up mr-2"></i> Kredit
                </a>

                <!-- Riwayat Transaksi -->
                <a href="{{ route('teller.transactions') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-history mr-2"></i> Riwayat Transaksi
                </a>

                <!-- All Users -->
                <a href="{{ route('teller.users') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-users mr-2"></i> All Users
                </a>

                <!-- Ranking -->
                <a href="{{ route('teller.ranking') }}" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-700 rounded">
                    <i class="fas fa-trophy mr-2"></i> Ranking
                </a>
            </nav>
        </div>

       
        <div class="p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 lg:p-6">
        @yield('content')
    </main>
</body>
</html>
