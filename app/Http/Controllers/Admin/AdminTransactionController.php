<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

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
            $q->whereHas('user', function ($qq) use ($search) {
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

    return view('admin.transactions', compact('transactions'));
}


    public function export(Request $request)
    {
        $date = $request->query('date'); // Ambil parameter tanggal dari URL
        $fileName = $date ? "transactions_{$date}.xlsx" : 'transactions_full.xlsx';

        return Excel::download(new TransactionsExport($date), $fileName);
    }
}