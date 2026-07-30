<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Transaction::with('user')
            ->when($this->date, function ($query) {
                return $query->whereDate('created_at', $this->date);
            })
            ->get()
            ->map(function ($transaction) {
                return [
                    'teller' => $transaction->teller->username,
                    'username' => $transaction->user->username,
                    'name' => $transaction->user->name,
                    'nis' => $transaction->user->nis,
                    'description' => $transaction->description,
                    'amount' => $transaction->amount,
                    'date' => $transaction->created_at->format('d M Y'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Teller', 'Username', 'Nama', 'NIS', 'Description', 'Amount', 'Date'];
    }
}
