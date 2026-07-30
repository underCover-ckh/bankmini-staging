<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TellerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminComplaintController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\Teller\DashboardController as TellerDashboardController;
use App\Http\Controllers\Teller\TransactionController as TellerTransactionController;
use App\Http\Controllers\Teller\RankingController as TellerRankingController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\RankingController as UserRankingController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('home');
});

// Route untuk login
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk admin
Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen user
    Route::resource('users', UserController::class);

    // Manajemen teller
    Route::resource('tellers', TellerController::class);

    // Manajemen admin
    Route::resource('admins', AdminController::class)->except(['create', 'store', 'destroy']);
    // Route reset password (Admin area)
    Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('reset.password');



    // Transaksi
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/export', [AdminTransactionController::class, 'export'])->name('transactions.export');

    // Keluhan Nasabah
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints');

    
    // Menyimpan keluhan ke database
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('user.complaints.store');
});

// Route untuk teller
Route::middleware([RoleMiddleware::class . ':teller'])->prefix('teller')->name('teller.')->group(function () {
    // Dashboard Teller
    Route::get('/dashboard', [TellerDashboardController::class, 'index'])->name('dashboard');

    // Debit
    Route::get('/debit', [TellerTransactionController::class, 'debit'])->name('debit');
    Route::post('/debit', [TellerTransactionController::class, 'storeDebit'])->name('debit.store');

    // Kredit
    Route::get('/credit', [TellerTransactionController::class, 'credit'])->name('credit');
    Route::post('/credit', [TellerTransactionController::class, 'storeCredit'])->name('credit.store');

    // Riwayat Transaksi
    Route::get('/transactions', [TellerTransactionController::class, 'index'])->name('transactions');
    Route::get('/transactions/export', [TellerTransactionController::class, 'export'])->name('transactions.export');
    Route::delete('/transactions/{id}', [TellerTransactionController::class, 'destroy'])->name('transactions.destroy');

    // Daftar Pengguna
    Route::get('/users', [TellerDashboardController::class, 'users'])->name('users');

    // Ranking
    Route::get('/ranking', [TellerRankingController::class, 'ranking'])->name('ranking');
});

// Route untuk user
Route::middleware([RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard User
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
  

    // Transaksi
    Route::get('/transactions', [UserTransactionController::class, 'index'])->name('transactions'); // Hanya untuk melihat transaksi

    // Akun
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::put('/account/update-name', [AccountController::class, 'updateName'])->name('account.updateName');
    Route::put('/account/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');

    // Tentang
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // Keluhan
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');

    // Ranking
    Route::get('/ranking', [UserRankingController::class, 'ranking'])->name('ranking');
});
