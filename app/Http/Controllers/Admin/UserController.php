<?php 

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
public function index(Request $request) {
    $search = $request->input('search');
    $filterName = $request->input('filter_name');
    $filterUsername = $request->input('filter_username');
    $filterNis = $request->input('filter_nis');
    $filterKelas = $request->input('filter_kelas');
    
    // Sorting parameters - whitelist untuk keamanan
    $allowedSorts = ['name', 'username', 'nis', 'kelas', 'jurusan', 'saldo', 'created_at'];
    $sortBy = $request->input('sort_by', 'name');
    if (!in_array($sortBy, $allowedSorts)) {
        $sortBy = 'name';
    }
    $sortOrder = strtolower($request->input('sort_order', 'asc')) === 'desc' ? 'desc' : 'asc';

    $users = User::where('role', 'user')
        // Search utama - TASK 6: Nama, Username, NIS, Kelas (Kelas = gabungan kelas + jurusan, cth: "X AKL")
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(kelas, ' ', jurusan) LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("CONCAT(kelas, jurusan) LIKE ?", ["%{$search}%"]);
            });
        })
        // Filter Nama
        ->when($filterName, function ($query, $filterName) {
            return $query->where('name', 'like', "%{$filterName}%");
        })
        // Filter Username
        ->when($filterUsername, function ($query, $filterUsername) {
            return $query->where('username', 'like', "%{$filterUsername}%");
        })
        // Filter NIS
        ->when($filterNis, function ($query, $filterNis) {
            return $query->where('nis', 'like', "%{$filterNis}%");
        })
        // Filter Kelas - gunakan LIKE agar konsisten dengan search (TASK 6: search by Kelas)
        ->when($filterKelas, function ($query, $filterKelas) {
            return $query->where('kelas', 'like', "%{$filterKelas}%");
        })
        // Apply sorting
        ->orderBy($sortBy, $sortOrder)
        ->paginate(10)
        ->appends($request->all()); // Keep filter params in pagination

    return view('admin.users.index', compact('users', 'sortBy', 'sortOrder'));
}


    /**
     * Menampilkan form untuk menambahkan user baru.
     */
    public function create() {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:50',
            'password' => 'required|min:6',
            'nis' => 'nullable|numeric',
            'jurusan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
        ]);

        // Periksa apakah name, username, atau nis sudah ada
        $existingUser = User::where('name', $request->name)
            ->orWhere('username', $request->username)
            ->orWhere('nis', $request->nis)
            ->first();

        if ($existingUser) {
            return redirect()->back()->withErrors([
                'error' => 'Akun dengan nama, username, atau NIS yang sama sudah ada.',
            ])->withInput();
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nis' => $request->nis,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'saldo' => 0, // Default saldo
            'role' => 'user', // Default role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:50',
            'nis' => 'nullable|numeric',
            'jurusan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
        ]);

        // Periksa apakah name, username, atau nis sudah ada, kecuali untuk user ini
        $existingUser = User::where(function ($query) use ($request) {
            $query->where('name', $request->name)
                ->orWhere('username', $request->username)
                ->orWhere('nis', $request->nis);
        })->where('id', '!=', $user->id)->first();

        if ($existingUser) {
            return redirect()->back()->withErrors([
                'error' => 'Akun dengan nama, username, atau NIS yang sama sudah ada.',
            ])->withInput();
        }

        $user->update($request->only('name', 'username', 'nis', 'jurusan', 'kelas'));

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}
