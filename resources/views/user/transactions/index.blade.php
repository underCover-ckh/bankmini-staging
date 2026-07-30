@extends('user.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-600 to-blue-800">

    <!-- Header -->
    <div class="relative px-6 pt-8 pb-16 text-white">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-xl font-bold">SIMANTAB</h1>
            <a href="{{ route('user.complaints.create') }}"
               class="flex items-center space-x-2 bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-600 rounded-full px-4 py-2 shadow-sm hover:shadow-md transition-all duration-300 border border-blue-100">
                <i class="ph ph-headset text-lg"></i>
            </a>
        </div>

        <!-- Greeting -->
        <div class="text-center mb-8">
            <p class="text-lg opacity-90 mb-1">Hello,</p>
            <h2 class="text-3xl font-bold mb-2">{{ $user->name }}</h2>
            <div class="inline-flex items-center bg-white/10 px-4 py-1 rounded-full">
                <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-sm">Active Account</span>
            </div>
        </div>

        <!-- Balance Card -->
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg border border-white/10 backdrop-blur-sm hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-6 -mt-6"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-8 -mb-8"></div>
            <div class="relative z-10">
                <p class="text-sm opacity-80 mb-1">Your Balance</p>
                <h3 class="text-4xl font-bold mb-6">Rp {{ number_format($user->saldo, 0, ',', '.') }}</h3>

                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs opacity-70">Account Number</p>
                        <p class="text-sm font-medium">{{ $user->nis }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition">
                            <i class="ph ph-arrow-down-left"></i>
                        </button>
                        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-full transition">
                            <i class="ph ph-arrow-up-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="relative z-10 px-6 -mt-8 mb-8">
        <div class="grid grid-cols-4 gap-4">
            <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-house text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Home</span>
            </a>
            <a href="{{ route('user.account') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-user text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Account</span>
            </a>
            <a href="{{ route('user.about') }}" class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-buildings text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">About</span>
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex flex-col items-center group">
                <div class="w-16 h-16 bg-white rounded-xl shadow-lg flex items-center justify-center group-hover:bg-blue-50 transition duration-300 mb-2">
                    <i class="ph ph-sign-out text-2xl text-blue-600"></i>
                </div>
                <span class="text-white text-sm font-medium">Logout</span>
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <!-- Transactions Section -->
    <div class="bg-white rounded-t-3xl pt-8 pb-12 px-6 min-h-[50vh]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Recent Transactions</h2>
        </div>

        <!-- Enhanced Date Filter -->
        <div class="mb-6 flex items-center">
            <div class="relative flex items-center">
                <div class="absolute left-3 text-blue-500">
                    <i class="ph ph-calendar text-lg"></i>
                </div>
                <input type="date" id="filter-date" 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64 appearance-none bg-white text-gray-700 cursor-pointer" />
            </div>
            <div id="selected-date-display" class="ml-3 px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hidden sm:block">
                All dates
            </div>
        </div>

        <!-- Transaction List -->
        <div class="space-y-3" id="transaction-list">
            @forelse ($transactions as $transaction)
                <div class="transaction-item bg-white border border-gray-100 rounded-xl p-4 shadow-sm hover:shadow-md transition flex justify-between items-center"
                     data-date="{{ $transaction->created_at->format('Y-m-d') }}">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $transaction->amount > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} mr-3">
                            <i class="ph ph-{{ $transaction->amount > 0 ? 'arrow-down-left' : 'arrow-up-right' }}"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $transaction->description }}</p>
                            <p class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->amount > 0 ? '+' : '-' }} Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500">{{ $transaction->user->name ?? 'N/A' }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ph ph-wallet text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500">No transactions yet</p>
                    <p class="text-gray-400 text-sm mt-1">Your transactions will appear here</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- JavaScript Filter Logic -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateFilter = document.getElementById('filter-date');
        const dateDisplay = document.getElementById('selected-date-display');
        const transactionItems = document.querySelectorAll('.transaction-item');

        dateFilter.addEventListener('change', function() {
            const selectedDate = this.value;
            
            // Update the displayed date
            if (selectedDate) {
                const formattedDate = new Date(selectedDate).toLocaleDateString('en-US', {
                    weekday: 'short',
                    month: 'short',
                    day: 'numeric'
                });
                dateDisplay.textContent = formattedDate;
                dateDisplay.classList.remove('bg-blue-50', 'text-blue-600');
                dateDisplay.classList.add('bg-blue-100', 'text-blue-700');
            } else {
                dateDisplay.textContent = 'All dates';
                dateDisplay.classList.remove('bg-blue-100', 'text-blue-700');
                dateDisplay.classList.add('bg-blue-50', 'text-blue-600');
            }

            // Filter transactions
            transactionItems.forEach(item => {
                const itemDate = item.getAttribute('data-date');
                if (!selectedDate || itemDate === selectedDate) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Trigger change event if there's a date in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('date')) {
            dateFilter.value = urlParams.get('date');
            dateFilter.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection