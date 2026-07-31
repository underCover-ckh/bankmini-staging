@extends('user.layout')

@section('content')
    <div class="p-4 min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
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
                </a>
            </div>
        </div>

        <!-- Premium Banking Card -->
        <div class="relative mb-8 group transform hover:-translate-y-1 transition duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-indigo-800 rounded-2xl shadow-2xl opacity-90 group-hover:opacity-100 transition duration-500"></div>
            <div class="relative bg-gradient-to-br from-blue-600/10 to-indigo-700/10 backdrop-blur-sm rounded-2xl p-6 overflow-hidden border border-white/20">
                <!-- Card Background Elements -->
                <div class="absolute -top-20 -right-20 w-64 h-124 bg-white/5 rounded-full"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-124 bg-white/5 rounded-full"></div>
                <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>

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
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-white text-xs font-medium backdrop-blur-sm">
                                <i class="ph ph-shield-check mr-1"></i> Secure Account
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-white/10">
                        <div>
                            <p class="text-xs font-light text-white/70">Account Number</p>
                            <p class="text-sm font-medium tracking-wider">{{ $user->nis }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 3 Ranking Widget -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 mb-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 flex items-center gap-1.5">
                    Top 3 Penabung Bulan Ini
                </h3>
                <span class="text-[10px] bg-amber-50 text-amber-600 font-semibold px-2 py-0.5 rounded-full">
                    {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                </span>
            </div>

            @if(isset($topThree) && $topThree->count() > 0)
                <div class="grid grid-cols-3 items-end gap-2 px-1 text-center">
                    <!-- Rank 2 -->
                    @if($topThree->has(1))
                        @php $siswa2 = $topThree->get(1); @endphp
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] font-bold text-gray-500 mb-1.5 block">
                                {{ $siswa2->monthly_transaction_count }} Nabung
                            </span>
                            <div class="w-full bg-gradient-to-t from-gray-200 to-gray-100 rounded-t-xl flex flex-col items-center justify-between py-3 shadow-sm border-t border-x border-gray-200/50" style="height: 80px;">
                                <div class="px-1 w-full">
                                    <p class="text-xs font-black text-gray-800 truncate">{{ explode(' ', $siswa2->name)[0] }}</p>
                                    <p class="text-[9px] text-gray-500 font-medium">Rank 2</p>
                                </div>
                                <span class="text-xl font-extrabold text-gray-400 leading-none">2</span>
                            </div>
                        </div>
                    @else
                        <div></div>
                    @endif

                    <!-- Rank 1 -->
                    @if($topThree->has(0))
                        @php $siswa1 = $topThree->get(0); @endphp
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] font-bold text-blue-600 mb-1.5 block">
                                {{ $siswa1->monthly_transaction_count }} Nabung
                            </span>
                            <div class="w-full bg-gradient-to-t from-blue-50 to-blue-100/70 rounded-t-xl flex flex-col items-center justify-between py-4 shadow-md border-t-2 border-x border-blue-200/60" style="height: 115px;">
                                <div class="px-1 w-full">
                                    <p class="text-sm font-black text-blue-900 truncate">{{ explode(' ', $siswa1->name)[0] }}</p>
                                    <p class="text-[9px] text-blue-500 font-bold tracking-wider uppercase">Rank 1</p>
                                </div>
                                <span class="text-3xl font-extrabold text-blue-600 leading-none">1</span>
                            </div>
                        </div>
                    @endif

                    <!-- Rank 3 -->
                    @if($topThree->has(2))
                        @php $siswa3 = $topThree->get(2); @endphp
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] font-bold text-amber-600 mb-1.5 block">
                                {{ $siswa3->monthly_transaction_count }} Nabung
                            </span>
                            <div class="w-full bg-gradient-to-t from-amber-100 to-amber-50 rounded-t-xl flex flex-col items-center justify-between py-3 shadow-sm border-t border-x border-amber-200/50" style="height: 60px;">
                                <div class="px-1 w-full">
                                    <p class="text-xs font-black text-amber-900 truncate">{{ explode(' ', $siswa3->name)[0] }}</p>
                                    <p class="text-[9px] text-amber-600 font-medium">Rank 3</p>
                                </div>
                                <span class="text-lg font-extrabold text-amber-400 leading-none">3</span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center opacity-40">
                            <span class="text-[10px] font-medium text-gray-400 mb-1.5 block">0 Nabung</span>
                            <div class="w-full bg-gradient-to-t from-gray-100 to-gray-50 rounded-t-xl flex flex-col items-center justify-between py-3 border-t border-x border-gray-200" style="height: 60px;">
                                <div class="px-1 w-full">
                                    <p class="text-xs font-black text-gray-400 truncate">-</p>
                                    <p class="text-[9px] text-gray-400 font-medium">Rank 3</p>
                                </div>
                                <span class="text-xl font-extrabold text-gray-300 leading-none">3</span>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-center text-xs text-gray-400 py-4">Belum ada aktivitas menabung bulan ini.</p>
            @endif
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-5 gap-3 mb-8">
            <!-- Transaksi -->
            <a href="{{ route('user.transactions') }}"
                class="flex flex-col items-center justify-center bg-white hover:bg-blue-50 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                    <i class="ph ph-currency-circle-dollar text-blue-600 text-xl"></i>
                </div>
                <span class="text-xs font-medium text-gray-700">History</span>
            </a>
            <!-- Ranking -->
            <a href="{{ route('user.ranking') }}"
                class="flex flex-col items-center justify-center bg-white hover:bg-blue-50 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mb-2">
                    <i class="ph ph-trophy text-2xl text-amber-600"></i>
                </div>
                <span class="text-xs font-medium text-gray-700">Ranking</span>
            </a>
            <!-- Akun -->
            <a href="{{ route('user.account') }}"
                class="flex flex-col items-center justify-center bg-white hover:bg-blue-50 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-2">
                    <i class="ph ph-user text-purple-600 text-xl"></i>
                </div>
                <span class="text-xs font-medium text-gray-700">Account</span>
            </a>
            <!-- About -->
            <a href="{{ route('user.about') }}"
                class="flex flex-col items-center justify-center bg-white hover:bg-blue-50 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-2">
                    <i class="ph ph-buildings text-green-600 text-xl"></i>
                </div>
                <span class="text-xs font-medium text-gray-700">About</span>
            </a>
            <!-- Logout -->
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex flex-col items-center justify-center bg-white hover:bg-blue-50 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-2">
                    <i class="ph ph-sign-out text-red-600 text-xl"></i>
                </div>
                <span class="text-xs font-medium text-gray-700">Logout</span>
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
            <div class="divide-y divide-gray-100 transaction-list max-h-[400px] overflow-y-auto">
                @forelse ($transactions as $transaction)
                    <div class="p-4 hover:bg-gray-50 transition duration-150">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $transaction->amount > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    <i class="ph ph-{{ $transaction->amount > 0 ? 'arrow-down-left' : 'arrow-up-right' }}"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">{{ $transaction->description }}</p>
                                    <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->amount > 0 ? '+' : '-' }} Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
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
    </div> <!-- Tag penutup utama yang sebelumnya hilang -->

    <style>
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