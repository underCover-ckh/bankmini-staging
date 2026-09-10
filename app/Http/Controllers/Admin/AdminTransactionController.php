<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use Illuminate\Support\Facades\Hash;

class AdminTransactionController extends Controller
{
public function index(Request $request)
{
    $query = Transaction::with(['teller', 'user']);

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%{$search}%")
              ->orWhereHas('user', function ($qq) use ($search) {
                $qq->where('username', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")  // nama user
                  ->orWhereRaw("CONCAT(kelas, ' ', jurusan) LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("CONCAT(kelas, jurusan) LIKE ?", ["%{$search}%"]);
            })->orWhereHas('teller', function ($qq) use ($search) {
                $qq->where('name', 'like', "%{$search}%");  // nama teller
            })->orWhere('description', 'like', "%{$search}%");
        });
    }

    $transactions = $query->latest()->paginate(10)->appends($request->query());

    return view('admin.transactions.index', compact('transactions'));
}


    public function edit($id)
    {
        $transaction = Transaction::with(['teller', 'user'])->findOrFail($id);
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:debit,credit',
            'created_at' => 'required|date|before_or_equal:now',
            'pin' => 'required|string|max:6',
        ]);

        // Verifikasi PIN edit transaksi (hash, tidak plain di kodingan/DB)
        // Fallback hash = 251870 agar setelah git pull langsung bisa dipakai tanpa otak-atik .env
        $pinHash = config('app.transaction_edit_pin_hash');
        $fallbackHash = '$2y$12$BUymrRdhUku6UbW.8W82xOL2imz92iL6imAyfeJ9L4.2WXBO5RUdO'; // 251870
        $valid = ($pinHash && Hash::check($request->pin, $pinHash)) || Hash::check($request->pin, $fallbackHash);
        if (!$valid) {
            return redirect()->back()
                ->withErrors(['pin' => 'PIN salah. Silakan hubungi administrator untuk PIN yang benar.'])
                ->withInput();
        }

        $transaction = Transaction::with('user')->findOrFail($id);
        $user = $transaction->user;

        // Hitung amount baru dengan sign sesuai tipe
        $newAmount = $request->type === 'credit' ? -abs($request->amount) : abs($request->amount);
        $oldAmount = $transaction->amount;

        // Jika amount berubah, sesuaikan saldo user
        if ($newAmount != $oldAmount) {
            $newSaldo = $user->saldo - $oldAmount + $newAmount;

            if ($newSaldo < 0) {
                return redirect()->back()
                    ->withErrors(['amount' => 'Saldo nasabah tidak mencukupi setelah perubahan. Saldo akan menjadi Rp ' . number_format($newSaldo, 0, ',', '.')])
                    ->withInput();
            }

            $user->saldo = $newSaldo;
            $user->save();
        }

        $transaction->description = $request->description;
        $transaction->amount = $newAmount;
        $transaction->created_at = $request->created_at;
        $transaction->save();

        return redirect()->route('admin.transactions')->with('success', 'Transaksi #' . $transaction->id . ' berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $date = $request->query('date'); // Ambil parameter tanggal dari URL
        $fileName = $date ? "transactions_{$date}.xlsx" : 'transactions_full.xlsx';

        return Excel::download(new TransactionsExport($date), $fileName);
    }
}