<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teller_id', // Pastikan kolom teller_id ada di tabel transactions
        'description',
        'amount',
    ];

    // Relasi ke model User (nasabah)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Teller
    public function teller()
    {
        return $this->belongsTo(User::class, 'teller_id'); // teller_id adalah foreign key
    }
}
