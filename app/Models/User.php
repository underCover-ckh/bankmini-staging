<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public static function monthlySavingsRanking(int $limit = 10)
    {
        return static::whereNotNull('nis')
            ->withCount(['transactions as monthly_transaction_count' => function ($query) {
                $query->where('amount', '>', 0)
                    ->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
            }])
            ->withSum(['transactions as monthly_transaction_amount' => function ($query) {
                $query->where('amount', '>', 0)
                    ->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
            }], 'amount')
            ->orderByDesc('monthly_transaction_count') ->orderByRaw('COALESCE(monthly_transaction_amount, 0) DESC')
            ->orderBy('name', 'asc')
            ->take($limit)
            ->get();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
