@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Edit Transaksi #{{ $transaction->id }}</h1>

    <a href="{{ route('admin.transactions') }}" class="inline-block mb-4 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow transition">
        &larr; Kembali ke Pantau Transaksi
    </a>

    @if ($errors->any())
        <div class="bg-red-100 dark:bg-red-900/40 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 p-4 rounded-lg shadow mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Info Transaksi (Read Only) -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6 border border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Informasi Transaksi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">ID Transaksi</span>
                <span class="font-mono font-semibold">{{ $transaction->id }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Tanggal</span>
                <span class="font-medium">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Teller</span>
                <span class="font-medium">{{ $transaction->teller->name ?? 'N/A' }} ({{ $transaction->teller->username ?? '-' }})</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Nasabah</span>
                <span class="font-medium">{{ $transaction->user->name ?? 'N/A' }} ({{ $transaction->user->username ?? '-' }})</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">NIS</span>
                <span class="font-mono">{{ $transaction->user->nis ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Kelas</span>
                <span class="font-mono">{{ trim(strtoupper($transaction->user->kelas ?? '') . ' ' . strtoupper($transaction->user->jurusan ?? '')) ?: 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Saldo Nasabah Saat Ini</span>
                <span class="font-semibold text-blue-600">Rp {{ number_format($transaction->user->saldo ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 dark:border-gray-700 py-2">
                <span class="text-gray-500 dark:text-gray-400">Jumlah Lama</span>
                <span class="font-semibold {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $transaction->amount > 0 ? '+' : '-' }}Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                    ({{ $transaction->amount > 0 ? 'Debit' : 'Kredit' }})
                </span>
            </div>
        </div>
    </div>

    <!-- Form Edit -->
    <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="description" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Deskripsi <span class="text-red-500">*</span></label>
            <textarea id="description" name="description" rows="3" required maxlength="255"
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">{{ old('description', $transaction->description) }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Contoh: menabung, Transaksi Debit, ditarik, dll.</p>
        </div>

        <div>
            <label for="type" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Jenis Transaksi <span class="text-red-500">*</span></label>
            <select id="type" name="type" required
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                <option value="debit" {{ old('type', $transaction->amount > 0 ? 'debit' : 'credit') == 'debit' ? 'selected' : '' }}>Debit (Menabung / + Saldo)</option>
                <option value="credit" {{ old('type', $transaction->amount > 0 ? 'debit' : 'credit') == 'credit' ? 'selected' : '' }}>Kredit (Penarikan / - Saldo)</option>
            </select>
        </div>

        <div>
            <label for="amount" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Nominal (Rp) <span class="text-red-500">*</span></label>
            <input type="text" id="amount" name="amount" required inputmode="numeric"
                value="{{ old('amount', number_format(abs($transaction->amount), 0, ',', '.')) }}"
                placeholder="Contoh: 10.000"
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            <p class="text-xs text-gray-400 mt-1">Masukkan angka tanpa Rp, contoh <code>50000</code> akan tampil <code>50.000</code>. Saldo nasabah akan otomatis disesuaikan.</p>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <div>
            <label for="created_at" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Tanggal & Jam Transaksi <span class="text-red-500">*</span></label>
            <input type="text" id="created_at" name="created_at" required placeholder="DD/MM/YYYY HH:MM"
                value="{{ old('created_at', $transaction->created_at->format('Y-m-d H:i')) }}"
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
            <p class="text-xs text-gray-400 mt-1">Format: <code>DD/MM/YYYY HH:MM</code> urutan <strong>Tanggal - Bulan - Tahun</strong> (contoh: 03/09/2026 15:02). Tidak boleh melebihi waktu sekarang ({{ now()->format('d/m/Y H:i') }}).</p>
        </div>

        <div>
            <label for="pin" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">PIN Verifikasi <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="password" id="pin" name="pin" required inputmode="numeric" maxlength="6" pattern="\d{6}" placeholder="Masukkan PIN 6 digit"
                    class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition pr-16">
                <button type="button" onclick="togglePin()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xs font-medium">Lihat</button>
            </div>
            <p class="text-xs text-gray-400 mt-1">Wajib memasukkan PIN verifikasi untuk konfirmasi edit. Tanpa PIN yang benar data tidak akan disimpan.</p>
        </div>

        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 text-sm text-yellow-800 dark:text-yellow-200">
            <strong>Perhatian:</strong> Mengubah nominal akan otomatis menyesuaikan <strong>saldo nasabah</strong>. Rumus: <code>saldo baru = saldo sekarang - jumlah lama + jumlah baru</code>. Jika saldo menjadi negatif, perubahan akan ditolak.
        </div>

        <div class="flex gap-3 pt-2">
            <a href="{{ route('admin.transactions') }}" class="flex-1 text-center px-4 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-lg transition font-medium">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg shadow transition font-semibold">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    function togglePin() {
        const pin = document.getElementById('pin');
        const btn = event.currentTarget;
        if (pin.type === 'password') {
            pin.type = 'text';
            btn.textContent = 'Sembunyi';
        } else {
            pin.type = 'password';
            btn.textContent = 'Lihat';
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        // Flatpickr tanggal: urutan DD/MM/YYYY (tanggal, bulan, tahun) + jam
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#created_at", {
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                altFormat: "d/m/Y H:i",
                allowInput: true,
                maxDate: "today",
                locale: { firstDayOfWeek: 1 }
            });
        }

        const amountInput = document.getElementById('amount');
        if (!amountInput) return;

        // Format saat ketik
        amountInput.addEventListener('input', () => {
            let cleanValue = amountInput.value.replace(/\D/g, '');
            amountInput.value = cleanValue ? Number(cleanValue).toLocaleString('id-ID') : '';
        });

        // Bersihkan format sebelum submit
        amountInput.form.addEventListener('submit', () => {
            amountInput.value = amountInput.value.replace(/\./g, '');
        });
    });
</script>
@endsection
