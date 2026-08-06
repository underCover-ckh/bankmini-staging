<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
        'nis',
        'jurusan',
        'saldo',
        'kelas',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Ranking menabung 2 bulan terakhir terhitung bergulir dari hari ini (Rolling 2 Months)
     */
    public static function monthlySavingsRanking(int $limit = 10)
    {
        // Tanggal hari ini (misal: 6 Agustus 2026)
        $endDate = now()->endOfDay();

        // Tepat 2 bulan ke belakang dari hari ini (misal: 6 Juni 2026)
        $startDate = now()->subMonths(2)->startOfDay();

        return static::whereNotNull('nis')
            ->withCount(['transactions as monthly_transaction_count' => function ($query) use ($startDate, $endDate) {
                $query->where('amount', '>', 0)
                    ->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->withSum(['transactions as monthly_transaction_amount' => function ($query) use ($startDate, $endDate) {
                $query->where('amount', '>', 0)
                    ->whereBetween('created_at', [$startDate, $endDate]);
            }], 'amount')
            ->having('monthly_transaction_count', '>', 0)
            ->orderByDesc('monthly_transaction_count')
            ->orderByRaw('COALESCE(monthly_transaction_amount, 0) DESC')
            ->orderBy('name', 'asc')
            ->take($limit)
            ->get();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}