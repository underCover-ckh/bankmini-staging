@extends('teller.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-100 dark:border-gray-700 transition-colors duration-200">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Form Debit</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 dark:bg-green-950/30 dark:border-green-900 dark:text-green-400 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 dark:bg-red-950/30 dark:border-red-900 dark:text-red-400 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teller.debit.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Username</label>
                <input type="text" id="username" name="username" required 
                       class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       autocomplete="username">
            </div>

            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">NIS</label>
                <input type="text" id="nis" name="nis" required 
                       class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       autocomplete="off">
            </div>

            <div>
                <label for="amount_display" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Jumlah Saldo</label>
                <input type="text" id="amount_display" required
                       class="w-full p-3 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Contoh: 1.000.000" autocomplete="off" inputmode="numeric" />
                <input type="hidden" name="amount" id="amount">
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                Submit
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const displayInput = document.getElementById('amount_display');
    const hiddenInput = document.getElementById('amount');

    displayInput.addEventListener('input', (e) => {
        let cursorPos = displayInput.selectionStart;
        let originalLength = displayInput.value.length;

        // Hapus semua karakter kecuali angka
        let rawValue = displayInput.value.replace(/\D/g, '');
        hiddenInput.value = rawValue;

        // Format ribuan dengan titik
        if (rawValue) {
            let formatted = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            displayInput.value = formatted;

            let newLength = formatted.length;
            cursorPos = cursorPos + (newLength - originalLength);
            displayInput.setSelectionRange(cursorPos, cursorPos);
        } else {
            displayInput.value = '';
        }
    });
});
</script>
@endsection