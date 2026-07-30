@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Keluhan dari User</h1>

    <!-- Daftar Keluhan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($complaints as $complaint)
        <div onclick="openModal({{ $complaint->id }})" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg cursor-pointer hover:shadow-xl transition">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $complaint->name }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $complaint->email }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 truncate">{{ $complaint->message }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-4">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
            Belum ada keluhan.
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $complaints->links('pagination::tailwind') }}
    </div>
</div>

<!-- Modal Box -->
<div id="complaintModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div onclick="closeModal()" class="absolute inset-0"></div> <!-- Area klik di luar modal -->
    <div class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-lg z-10">
        <h2 id="modalName" class="text-lg font-semibold mb-2 dark:text-white">Nama User</h2>
        <p id="modalEmail" class="text-sm text-gray-500 dark:text-gray-400">Email User</p>
        <p id="modalMessage" class="text-sm text-gray-800 dark:text-gray-300 mt-4">Pesan Keluhan</p>
        <p id="modalDate" class="text-xs text-gray-400 dark:text-gray-500 mt-4">Tanggal Keluhan</p>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    const complaints = @json($complaints);

    function openModal(id) {
        const modal = document.getElementById('complaintModal');
        const complaint = complaints.find(c => c.id === id);

        // Set data ke modal
        document.getElementById('modalName').textContent = complaint.name;
        document.getElementById('modalEmail').textContent = complaint.email;
        document.getElementById('modalMessage').textContent = complaint.message;
        document.getElementById('modalDate').textContent = new Date(complaint.created_at).toLocaleString('id-ID', {
            day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'
        });

        // Tampilkan modal
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('complaintModal');
        modal.classList.add('hidden');
    }
</script>
@endsection