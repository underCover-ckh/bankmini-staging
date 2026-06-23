@extends('user.layout')

@section('content')
    <div class="p-4 min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Header Section -->
    <!-- Professional Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">
    {{ \Carbon\Carbon::now()->translatedFormat('l') }}
</p>

            <h1 class="text-2xl font-bold text-gray-800">
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ $user->name }}
                </span>
            </h1>
            <p class="text-gray-500 text-sm mt-1 flex items-center">
                <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                Account active • Last login: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
            </p>
        </div>

        <!-- Quick Actions -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('user.complaints.create') }}"
                class="flex items-center space-x-2 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-600 rounded-full px-4 py-2 shadow-sm hover:shadow-md transition-all duration-300 border border-blue-100">
                <i class="ph ph-headset text-lg"></i>
                {{-- <span class="text-sm font-medium">Customer Support</span> --}}
            </a>
        </div>
    </div>

    <!-- Premium Banking Card -->
    <div class="relative mb-8 group transform hover:-translate-y-1 transition duration-300">
        <div
            class="absolute inset-0 bg-gradient-to-br from-blue-700 to-indigo-800 rounded-2xl shadow-2xl opacity-90 group-hover:opacity-100 transition duration-500">
        </div>
        <div
            class="relative bg-gradient-to-br from-blue-600/10 to-indigo-700/10 backdrop-blur-sm rounded-2xl p-6 overflow-hidden border border-white/20">
            <!-- Card Background Elements -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2">
            </div>

            <!-- Card Content -->
            <div class="relative z-10 text-white">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <p class="text-sm font-light text-white/80 mb-2">Available Balance</p>
                        <h2 class="text-3xl font-bold tracking-tight">
                            Rp {{ number_format($user->saldo, 0, ',', '.') }}
                        </h2>
                    </div>
                    <div class="flex flex-col items-end">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-white text-xs font-medium backdrop-blur-sm">
                            <i class="ph ph-shield-check mr-1"></i> Secure Account
                        </span>
                        {{-- <img src="{{ asset('images/bank-logo-white.png') }}" alt="Bank Logo" class="h-6 mt-4 opacity-90"> --}}
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-white/10">
                    <div>
                        <p class="text-xs font-light text-white/70">Account Number</p>
                        <p class="text-sm font-medium tracking-wider">{{ $user->nis }}</p>
                    </div>
                    {{-- <div class="flex space-x-3">
                        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition backdrop-blur-sm">
                            <i class="ph ph-arrow-up-right text-white"></i>
                        </button>
                        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition backdrop-blur-sm">
                            <i class="ph ph-arrow-down-left text-white"></i>
                        </button>
                        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition backdrop-blur-sm">
                            <i class="ph ph-credit-card text-white"></i>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid - Modern Horizontal Layout -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <!-- Transactions -->
        <a href="{{ route('user.transactions') }}"
        class="flex items-center gap-4 bg-white hover:bg-blue-50/50 p-4 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100/70 group">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <i class="ph ph-currency-circle-dollar text-2xl"></i>
            </div>
        <div class="overflow-hidden">
            <span class="block text-sm font-semibold text-gray-800 truncate">Transactions</span>
        </div>
        </a>
        <!-- Ranking -->
        <a href="{{ route('user.ranking') }}"
        class="flex items-center gap-4 bg-white hover:bg-amber-50/50 p-4 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100/70 group">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <i class="ph ph-trophy text-2xl"></i>
            </div>
            <div class="overflow-hidden">
                <span class="block text-sm font-semibold text-gray-800 truncate">Ranking</span>
            </div>
        </a>
        <!-- Account -->
        <a href="{{ route('user.account') }}"
        class="flex items-center gap-4 bg-white hover:bg-purple-50/50 p-4 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100/70 group">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <i class="ph ph-user text-2xl"></i>
            </div>
            <div class="overflow-hidden">
                <span class="block text-sm font-semibold text-gray-800 truncate">Account</span>
            </div>
        </a>
        <!-- About -->
        <a href="{{ route('user.about') }}"
            class="flex items-center gap-4 bg-white hover:bg-green-50/50 p-4 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100/70 group">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <i class="ph ph-buildings text-2xl"></i>
            </div>
            <div class="overflow-hidden">
                <span class="block text-sm font-semibold text-gray-800 truncate">About</span>
            </div>
        </a>
        <!-- Logout -->
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-4 bg-white hover:bg-red-50/50 p-4 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100/70 group">
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <i class="ph ph-sign-out text-2xl"></i>
            </div>
            <div class="overflow-hidden">
                <span class="block text-sm font-semibold text-gray-800 truncate">Logout</span>
            </div>
        </a>
    </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
            <div class="p-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800">Recent Transactions</h3>
                    <a href="{{ route('user.transactions') }}" class="text-blue-600 text-xs font-medium flex items-center">
                        View All <i class="ph ph-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($transactions as $transaction)
                    <div class="p-4 hover:bg-gray-50 transition duration-150">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center 
                                    {{ $transaction->amount > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    <i class="ph ph-{{ $transaction->amount > 0 ? 'arrow-down-left' : 'arrow-up-right' }}"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $transaction->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-sm font-semibold {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->amount > 0 ? '+' : '-' }} Rp
                                    {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $transaction->user->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="ph ph-wallet text-3xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm">No transactions yet</p>
                        <p class="text-gray-400 text-xs mt-1">Your transactions will appear here</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- <!-- Savings Progress (Optional) -->
        <div class="bg-white rounded-2xl shadow-sm p-4 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800">Savings Progress</h3>
                <span class="text-xs text-blue-600 font-medium">Rp 1,200,000 / Rp 2,000,000</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 60%"></div>
            </div>
            <div class="flex justify-between items-center mt-2">
                <span class="text-xs text-gray-500">60% completed</span>
                <span class="text-xs text-gray-500">Target: June 2023</span>
            </div>
        </div>
    </div> --}}

    {{-- <!-- Chart.js for Visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Spending Chart
        const ctx = document.createElement('canvas');
        ctx.id = 'spendingChart';
        document.querySelector('main').appendChild(ctx);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Savings',
                    data: [500000, 750000, 900000, 1100000, 1300000, 1500000],
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script> --}}

    <style>
        /* Custom scrollbar for transactions */
        .transaction-list {
            scrollbar-width: thin;
            scrollbar-color: #e5e7eb #f9fafb;
        }

        .transaction-list::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .transaction-list::-webkit-scrollbar-track {
            background: #f9fafb;
        }

        .transaction-list::-webkit-scrollbar-thumb {
            background-color: #e5e7eb;
            border-radius: 20px;
        }
    </style>
@endsection