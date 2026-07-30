<?php 

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TellerController extends Controller
{
    /**
     * Menampilkan daftar teller.
     */
    public function index(Request $request) {
        $search = $request->input('search');

        // Filter berdasarkan nama dan role teller
        $tellers = User::where('role', 'teller')
                       ->where('name', 'like', "%{$search}%")
                       ->paginate(10); // Menambahkan pagination dengan 10 item per halaman

        return view('admin.tellers.index', compact('tellers'));
    }

    /**
     * Menampilkan form untuk menambahkan teller baru.
     */
    public function create() {
        return view('admin.tellers.create');
    }

    /**
     * Menyimpan teller baru ke database.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:50',
            'password' => 'required|min:6',
            'jurusan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nis' => null, // NIS tidak diisi
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'saldo' => 0, // Default saldo
            'role' => 'teller', // Default role
        ]);

        return redirect()->route('admin.tellers.index')->with('success', 'Teller berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit teller.
     */
    public function edit(User $teller) {
        return view('admin.tellers.edit', compact('teller'));
    }

    /**
     * Memperbarui data teller di database.
     */
    public function update(Request $request, User $teller) {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users,username,' . $teller->id . '|max:50',
            'jurusan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
        ]);

        $teller->update($request->only('name', 'username', 'jurusan', 'kelas'));

        return redirect()->route('admin.tellers.index')->with('success', 'Teller berhasil diperbarui');
    }

    /**
     * Menghapus teller dari database.
     */
    public function destroy(User $teller) {
        $teller->delete();

        return redirect()->route('admin.tellers.index')->with('success', 'Teller berhasil dihapus');
    }
}
