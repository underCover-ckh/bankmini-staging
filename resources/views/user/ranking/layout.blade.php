{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Mini - Dashboard</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <script src="https://unpkg.com/phosphor-icons"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex">

    <aside class="w-64 bg-gradient-to-b from-blue-600 to-indigo-800 text-white flex flex-col justify-between p-5 min-h-screen shadow-xl fixed left-0 top-0 z-50">
        <div class="space-y-6">
            <div class="flex items-center gap-3 px-2 py-3 border-b border-white/10">
                <div class="p-2 bg-white/10 rounded-xl">
                    <i class="ph-bank-bold text-2xl text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg leading-tight tracking-wide">BANK MINI</h2>
                    <span class="text-xs text-blue-200/80 font-medium">Staging Area</span>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                    <i class="ph-squares-four text-xl"></i>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                    <i class="ph-arrows-left-right text-xl"></i>
                    <span>Riwayat Transaksi</span>
                </a>

                <a href="{{ route('ranking.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white text-blue-700 shadow-sm transition-all text-sm font-bold">
                    <i class="ph-trophy text-xl"></i>
                    <span>Ranking Bulanan</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                    <i class="ph-user-gear text-xl"></i>
                    <span>Pengaturan Akun</span>
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-white/10 space-y-3">
            <div class="flex items-center gap-3 px-2 py-1">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name ?? 'FI', 0, 2) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name ?? 'Fian Developer' }}</p>
                    <p class="text-xs text-blue-200/70 truncate">{{ Auth::user()->username ?? 'Nasabah' }}</p>
                </div>
            </div>

            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-red-200 hover:bg-red-500/20 hover:text-white transition-all text-sm font-medium">
                <i class="ph-sign-out text-xl"></i>
                <span>Keluar Aplikasi</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <div class="flex-1 pl-64 flex flex-col min-h-screen">
        
        <header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between px-8 sticky top-0 z-40 transition-colors">
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Selamat Datang kembali di Sistem Layanan Bank Mini
            </div>
            
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 px-3 py-1 rounded-full text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Sistem Aktif
                </span>
            </div>
        </header>

        <main class="flex-grow bg-gray-50/50 dark:bg-gray-900/50 transition-colors">
            @yield('content')
        </main>

        <footer class="p-5 text-center text-xs text-gray-400 dark:text-gray-600 border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-800 transition-colors">
            &copy; {{ date('Y') }} Bank Mini - Project Leader: Rafi & Fullstack: Fian. All rights reserved.
        </footer>
    </div>

</body>
</html> --}}