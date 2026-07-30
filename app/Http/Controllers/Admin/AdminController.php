<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman manajemen admin.
     */
    public function index() {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Menampilkan form untuk mengedit akun admin.
     */
    public function edit(User $admin) {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Memperbarui data admin di database.
     */
    public function update(Request $request, User $admin) {
        $request->validate([
            'username' => 'required|unique:users,username,' . $admin->id . '|max:50',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only('username');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Menampilkan form reset password untuk user atau teller.
     */


    /**
     * Mereset password user atau teller.
     */
    public function resetPassword(Request $request) {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user,teller', // Validasi role
        ]);

        // Cari user berdasarkan username dan role
        $user = User::where('username', $request->username)
                    ->where('role', $request->role)
                    ->first();

        if (!$user) {
            return redirect()->back()->withErrors([
                'error' => 'Username tidak ditemukan untuk role yang dipilih.',
            ]);
        }

        // Update password
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password berhasil direset untuk ' . ucfirst($request->role));
    }
}
