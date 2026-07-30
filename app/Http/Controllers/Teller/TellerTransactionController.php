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
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->paginate(10);

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