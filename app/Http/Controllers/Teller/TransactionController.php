<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

class TransactionController extends Controller
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
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $user = User::where('username', $request->username)
            ->where('nis', $request->nis)
            ->firstOrFail();

        // Tambahkan saldo ke user
        $user->saldo += $request->amount;
        $user->save();

        // Simpan transaksi
        Transaction::create([
            'user_id' => $user->id,
            'teller_id' => auth()->id(), // ID teller yang sedang login
            'description' => $request->description ?? 'Transaksi Debit',
            'amount' => $request->amount,
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
        $request->validate([
            'username' => 'required|exists:users,username',
            'nis' => 'required|exists:users,nis',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
        ]);

        $user = User::where('username', $request->username)
            ->where('nis', $request->nis)
            ->firstOrFail();

        // Kurangi saldo user
        if ($user->saldo < $request->amount) {
            return redirect()->back()->withErrors(['amount' => 'Saldo tidak mencukupi.']);
        }

        $user->saldo -= $request->amount;
        $user->save();

        // Simpan transaksi
        Transaction::create([
            'user_id' => $user->id,
            'teller_id' => auth()->id(), // ID teller yang sedang login
            'description' => $request->description,
            'amount' => -$request->amount,
        ]);

        return redirect()->route('teller.credit')->with('success', 'Saldo berhasil dikurangi.');
    }

    // Halaman Riwayat Transaksi
// Halaman Riwayat Transaksi
    public function index(Request $request)
{
    // Mendapatkan parameter dari request
    $date = $request->input('date');
    $searchTerm = $request->input('search');
    
    // Parameter sorting (default: tanggal terbaru)
    $sort = $request->input('sort', 'created_at');
    $direction = strtolower($request->input('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

    // Query dasar dengan JOIN ke tabel users agar bisa sorting kolom milik user
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

    // Ambil transaksi dengan pagination & bawa relasi user
    $transactions = $query->with('user')
        ->orderBy($orderBy, $direction)
        ->paginate(10)
        ->appends($request->all());

    return view('teller.transactions', compact('transactions'));
}



    // Hapus Transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $user = $transaction->user;
    
        // Kurangi saldo user sesuai transaksi
        $user->saldo -= $transaction->amount;
        $user->save();
    
        // Hapus transaksi
        $transaction->delete();
    
        return redirect()->route('teller.transactions')->with('success', 'Transaksi berhasil dihapus dan saldo dikurangi.');
    }
    

    // Export Transaksi ke Excel
    public function export(Request $request)
    {
        $date = $request->input('date');
        $fileName = $date ? "transactions_{$date}.xlsx" : 'transactions_full.xlsx';

        return Excel::download(new TransactionsExport($date), $fileName);
    }

    
}
