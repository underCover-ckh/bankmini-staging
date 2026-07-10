<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teller Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="flex flex-col lg:flex-row bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen">

    <header class="w-full bg-white dark:bg-gray-800 shadow-md p-4 flex items-center justify-between lg:hidden transition-colors duration-200">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logobppi.png') }}" alt="Logo Bank Mini" class="h-8 w-auto">
            <h2 class="text-lg font-bold text-blue-600 dark:text-white">Bank Mini</h2>
        </div>
        <button id="menu-toggle-btn" class="text-gray-600 dark:text-gray-300 focus:outline-none p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            <i id="menu-toggle-icon" class="ph ph-list text-2xl"></i>
        </button>
    </header>

    <aside id="sidebar-menu" class="hidden lg:flex w-full lg:w-64 bg-white dark:bg-gray-800 shadow-lg flex-col justify-between min-h-screen lg:sticky lg:top-0 overflow-y-auto transition-colors duration-200">
        <div class="p-6">
            <div class="hidden lg:flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold text-blue-600 dark:text-white">Bank Mini</h2>
                <img src="{{ asset('images/logobppi.png') }}" alt="Logo Bank Mini" class="h-10 w-auto ml-4">
            </div>

            <div class="mb-6 p-4 bg-blue-50 dark:bg-gray-700/50 border border-blue-100 dark:border-gray-600 rounded-xl shadow-sm">
                <p class="text-[11px] font-bold text-gray-400 dark:text-gray-400 uppercase tracking-wider mb-0.5">Teller Active</p>
                <p class="text-base font-black text-blue-600 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-300 truncate mt-0.5">{{ Auth::user()->email }}</p>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('teller.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-house text-lg"></i> Dashboard
                </a>

                <a href="{{ route('teller.debit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-arrow-circle-down text-lg text-emerald-500"></i> Debit
                </a>

                <a href="{{ route('teller.credit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-arrow-circle-up text-lg text-amber-500"></i> Kredit
                </a>

                <a href="{{ route('teller.transactions') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-clock-counter-clockwise text-lg"></i> Riwayat Transaksi
                </a>

                <a href="{{ route('teller.users') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-users text-lg"></i> All Users
                </a>

                <a href="{{ route('teller.ranking') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700/50 hover:text-blue-600 rounded-xl transition-all">
                    <i class="ph ph-trophy text-lg text-yellow-500"></i> Ranking
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl shadow-sm transition-all text-sm">
                    <i class="ph ph-sign-out text-lg"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-4 lg:p-6 w-full overflow-x-hidden">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggleBtn = document.getElementById('menu-toggle-btn');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const menuToggleIcon = document.getElementById('menu-toggle-icon');

            if (menuToggleBtn && sidebarMenu) {
                menuToggleBtn.addEventListener('click', () => {
                    // Toggle class hidden pada sidebar agar muncul/hilang di mobile
                    sidebarMenu.classList.toggle('hidden');
                    
                    // Ganti icon hamburger (list) menjadi tanda silang (x) saat terbuka
                    if (sidebarMenu.classList.contains('hidden')) {
                        menuToggleIcon.className = 'ph ph-list text-2xl';
                    } else {
                        menuToggleIcon.className = 'ph ph-x text-2xl';
                    }
                });
            }
        });
    </script>
</body>
</html>