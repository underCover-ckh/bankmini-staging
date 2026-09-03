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
 * Mengambil periode ranking aktif.
 *
 * Periode:
 * Agustus - September
 * Oktober - November
 * Desember - Januari
 * Februari - Maret
 * April - Mei
 * Juni - Juli
 */
public static function getCurrentRankingPeriod(): array
{
    $today = now();

    $month = $today->month;
    $year = $today->year;

    switch ($month) {

        case 8:
        case 9:
            $start = Carbon::create($year, 8, 1)->startOfDay();
            break;

        case 10:
        case 11:
            $start = Carbon::create($year, 10, 1)->startOfDay();
            break;

        case 12:
            $start = Carbon::create($year, 12, 1)->startOfDay();
            break;

        case 1:
            $start = Carbon::create($year - 1, 12, 1)->startOfDay();
            break;

        case 2:
        case 3:
            $start = Carbon::create($year, 2, 1)->startOfDay();
            break;

        case 4:
        case 5:
            $start = Carbon::create($year, 4, 1)->startOfDay();
            break;

        default:
            // Juni - Juli
            $start = Carbon::create($year, 6, 1)->startOfDay();
            break;
    }

    $end = $start->copy()->addMonth()->endOfMonth();

    return [
        'start' => $start,
        'end' => $end,
        'label' => $start->translatedFormat('F') . ' - ' . $end->translatedFormat('F Y')
    ];
}


/**
 * Ranking Menabung Periode 2 Bulanan
 *
 * Urutan Ranking (revisi):
 * 1. Jumlah hari menabung (konsistensi)
 * 2. Jika hari sama -> Saldo tabungan
 */
public static function monthlySavingsRanking(int $limit = 10)
{
    //Carbon::setTestNow('01-10-2026');
    $period = static::getCurrentRankingPeriod();

    $startDate = $period['start'];
    $endDate   = $period['end'];

    return static::query()
        ->select('users.*')
        ->whereNotNull('nis')

        // Jumlah transaksi
        ->selectSub(function ($query) use ($startDate, $endDate) {
            $query->from('transactions')
                ->selectRaw('COUNT(*)')
                ->whereColumn('transactions.user_id', 'users.id')
                ->where('amount', '>', 0)
                ->whereBetween('created_at', [$startDate, $endDate]);
        }, 'transaction_count')

        // Jumlah hari berbeda menabung
        ->selectSub(function ($query) use ($startDate, $endDate) {
            $query->from('transactions')
                ->selectRaw('COUNT(DISTINCT DATE(created_at))')
                ->whereColumn('transactions.user_id', 'users.id')
                ->where('amount', '>', 0)
                ->whereBetween('created_at', [$startDate, $endDate]);
        }, 'saving_days')

        // Hanya siswa yang menabung pada periode ini
        ->whereExists(function ($query) use ($startDate, $endDate) {
            $query->from('transactions')
                ->whereColumn('transactions.user_id', 'users.id')
                ->where('amount', '>', 0)
                ->whereBetween('created_at', [$startDate, $endDate]);
        })

        ->orderByDesc('saving_days')
        ->orderByDesc('saldo')
        ->orderBy('name')

        ->limit($limit)
        ->get();
}

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}