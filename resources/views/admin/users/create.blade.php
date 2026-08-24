@extends('admin.layout')

@section('content')
<div class="p-6 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 rounded-lg shadow-lg transition-colors duration-200">
    <h2 class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-6">Tambah User Baru</h2>

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.users.index') }}" class="inline-block mb-4 px-4 py-2 bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 text-white rounded-lg shadow transition">
        &larr; Kembali
    </a>

    <!-- Tampilkan error validasi -->
    @if ($errors->any())
        <div class="bg-red-100 dark:bg-red-900/40 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 p-4 rounded-lg shadow mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Tambah User -->
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition" maxlength="100">
        </div>

        <div>
            <label for="username" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition" maxlength="50">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition" minlength="6">
        </div>

        <div>
            <label for="nis" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">NIS</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa"
                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
        </div>

        <!-- Kelas & Jurusan - Responsive Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="kelas" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Kelas</label>
                <select id="kelas" name="kelas"
                    class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    <option value="">Pilih Kelas</option>
                    <option value="x" {{ old('kelas') == 'x' ? 'selected' : '' }}>X</option>
                    <option value="xi" {{ old('kelas') == 'xi' ? 'selected' : '' }}>XI</option>
                    <option value="xii" {{ old('kelas') == 'xii' ? 'selected' : '' }}>XII</option>
                </select>
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Jurusan</label>
                <select id="jurusan" name="jurusan"
                    class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    <option value="">Pilih Jurusan</option>
                    <option value="tjkt1" {{ old('jurusan') == 'tjkt1' ? 'selected' : '' }}>TJKT 1</option>
                    <option value="tjkt2" {{ old('jurusan') == 'tjkt2' ? 'selected' : '' }}>TJKT 2</option>
                    <option value="pplg" {{ old('jurusan') == 'pplg' ? 'selected' : '' }}>PPLG</option>
                    <option value="akl" {{ old('jurusan') == 'akl' ? 'selected' : '' }}>AKL</option>
                    <option value="acp" {{ old('jurusan') == 'acp' ? 'selected' : '' }}>ACP</option>
                </select>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-4 py-3 rounded-lg shadow transition font-semibold">
            Simpan
        </button>
    </form>
</div>
@endsection