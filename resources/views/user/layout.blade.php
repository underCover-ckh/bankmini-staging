<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script><!-- Pastikan Anda menggunakan Vite untuk CSS -->
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen">
    <!-- Header
    <header class="bg-blue-600 text-white p-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">Bank Mini</h1>
            <nav class="space-x-4">
                <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('user.transactions') }}" class="hover:underline">Riwayat Transaksi</a>
                <a href="{{ route('user.account') }}" class="hover:underline">Akun</a>
                <a href="{{ route('logout') }}" class="hover:underline" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </nav>
        </div>
    </header> -->

    <!-- Main Content -->
    <main class="w-full h-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <!-- <footer class="bg-gray-800 text-white text-center p-4 mt-6">
        <p>&copy; {{ date('Y') }} Bank Mini. All rights reserved.</p>
    </footer> --> 
</body>
</html>