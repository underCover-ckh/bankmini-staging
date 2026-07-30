@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Teller</h2>

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.tellers.index') }}" class="inline-block mb-4 px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
        &larr; Kembali
    </a>

    <!-- Tampilkan error validasi -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Teller -->
    <form action="{{ route('admin.tellers.update', $teller->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium mb-2">Nama</label>
            <input type="text" id="name" name="name" value="{{ $teller->name }}" placeholder="Nama Lengkap" required 
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" maxlength="100">
        </div>

        <div>
            <label for="username" class="block text-sm font-medium mb-2">Username</label>
            <input type="text" id="username" name="username" value="{{ $teller->username }}" placeholder="Username" required 
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" maxlength="50">
        </div>

        <div>
            <label for="jurusan" class="block text-sm font-medium mb-2">Jurusan</label>
            <input type="text" id="jurusan" name="jurusan" value="{{ $teller->jurusan }}" placeholder="Jurusan" 
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="kelas" class="block text-sm font-medium mb-2">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="{{ $teller->kelas }}" placeholder="Kelas" 
                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg shadow hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection