<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class TellerTransactionController extends Controller
{
    // Halaman Debit
    public function debit()
    {
        return view('teller.debit');
    }

    // Proses Debit
    public function storeDebit(Request $request)
{
    $request->validate([
        'username' => 'required|exists:users,username',
        'nis' => 'required|exists:users,nis',
        'amount' => 'required|string', // gunakan string karena input ribuan
        'description' => 'required|string|max:255',
    ]);

    // Bersihkan format angka (misal: 1.000.000 → 1000000)
    $amount = (int) str_replace('.', '', $request->amount);

    // Validasi minimal 1 setelah di-convert
    if ($amount < 1) {
        return back()->withErrors(['amount' => 'Jumlah saldo minimal Rp1.']);
    }

    // Cari user berdasarkan username dan NIS
    $user = User::where('username', $request->username)
                ->where('nis', $request->nis)
                ->firstOrFail();

    // Tambahkan saldo
    $user->saldo += $amount;
    $user->save();

    // Simpan transaksi
    Transaction::create([
        'user_id'     => $user->id,
        'teller_id'   => auth()->id(),
        'description' => $request->description,
        'amount'      => $amount,
    ]);

    return redirect()->route('teller.debit')->with('success', 'Saldo berhasil ditambahkan.');
}
    

    // Halaman Kredit
    public function credit()
    {
        return view('teller.credit');
    }

    // Proses Kredit
    public function storeCredit(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required|exists:users,username',
        'nis' => 'required|exists:users,nis',
        'amount' => 'required|string', // string karena diformat ribuan (e.g., "1.000.000")
        'description' => 'required|string|max:255',
    ]);

    // Bersihkan format angka (hilangkan titik)
    $amount = (int) str_replace('.', '', $request->amount);

    // Ambil user berdasarkan username dan NIS
    $user = User::where('username', $request->username)
                ->where('nis', $request->nis)
                ->firstOrFail();

    // Validasi saldo cukup
    if ($user->saldo < $amount) {
        return back()->withErrors(['amount' => 'Saldo tidak mencukupi.']);
    }

    // Kurangi saldo user
    $user->saldo -= $amount;
    $user->save();

    // Simpan transaksi dengan nilai minus
    Transaction::create([
        'user_id'     => $user->id,
        'teller_id'   => auth()->id(),
        'description' => $request->description,
        'amount'      => -$amount, // dikurangi karena kredit
    ]);

    return redirect()->route('teller.credit')->with('success', 'Saldo berhasil dikurangi.');
}


    // Halaman Riwayat Transaksi
    public function index(Request $request)
    {
        // Parameter filter & search
        $date = $request->input('date');
        $searchTerm = $request->input('search');
        
        // Parameter sorting (default: tanggal terbaru)
        $sort = $request->input('sort', 'created_at');
        $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        // Query dasar dengan JOIN ke tabel users agar bisa sorting & searching kolom milik user (Nama, Username, NIS, Kelas)
        $query = Transaction::query()
            ->select('transactions.*')
            ->join('users', 'transactions.user_id', '=', 'users.id');

        // Filter berdasarkan tanggal jika ada
        if ($date) {
            $query->whereDate('transactions.created_at', $date);
        }

        // Pencarian berdasarkan Username, Nama, NIS, Kelas (sesuai TASK 6) - Kelas = gabungan kelas + jurusan (cth: "X AKL")
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('users.username', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.nis', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.kelas', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.jurusan', 'like', '%' . $searchTerm . '%')
                  ->orWhereRaw("CONCAT(users.kelas, ' ', users.jurusan) LIKE ?", ["%{$searchTerm}%"])
                  ->orWhereRaw("CONCAT(users.kelas, users.jurusan) LIKE ?", ["%{$searchTerm}%"])
                  ->orWhere('transactions.description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Pemetaan kolom sorting untuk mencegah SQL Injection
        $sortColumns = [
            'username'    => 'users.username',
            'name'        => 'users.name',
            'nis'         => 'users.nis',
            'kelas'       => 'users.kelas',
            'description' => 'transactions.description',
            'amount'      => 'transactions.amount',
            'created_at'  => 'transactions.created_at',
        ];

        $orderBy = $sortColumns[$sort] ?? 'transactions.created_at';

        // Ambil transaksi dengan pagination, eager load relasi user, preserve query string
        $transactions = $query->with('user')
            ->orderBy($orderBy, $direction)
            ->paginate(10)
            ->appends($request->query());

        return view('teller.transactions', compact('transactions'));
    }

    // Hapus Transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('teller.transactions')->with('success', 'Transaksi berhasil dihapus.');
    }
}