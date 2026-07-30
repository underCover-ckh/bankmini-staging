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
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('username', 'like', "%{$search}%")
              ->orWhere('nis', 'like', "%{$search}%")
              ->orWhere('kelas', 'like', "%{$search}%")
              ->orWhere('jurusan', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%");  // nama user
        })->orWhereHas('teller', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");  // nama teller
        })->orWhere('description', 'like', "%{$search}%");
    }

    $transactions = $query->latest()->paginate(10);

    return view('admin.transactions', compact('transactions'));
}


    public function export(Request $request)
    {
        $date = $request->query('date'); // Ambil parameter tanggal dari URL
        $fileName = $date ? "transactions_{$date}.xlsx" : 'transactions_full.xlsx';

        return Excel::download(new TransactionsExport($date), $fileName);
    }
}