<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Customer\HomeController as CustomerHomeController;
use App\Http\Controllers\Customer\OrderController; // ✅ TAMBAHAN

Route::get('/', function () {
    return view('welcome');
});


// ─── REDIRECT DASHBOARD SESUAI ROLE ─────────────────────────
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'customer') {
        return redirect()->route('customer.home');
    }

    return app(DashboardController::class)->index(request());
})->middleware(['auth', 'verified'])->name('dashboard');


// ─── PROFILE ────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ─── CUSTOMER AREA ─────────────────────────────────────────
Route::middleware(['auth', 'role:customer'])
    ->prefix('my')
    ->name('customer.')
    ->group(function () {

        Route::get('/home', [CustomerHomeController::class, 'index'])->name('home');
        Route::get('/transactions', [CustomerHomeController::class, 'transactions'])->name('transactions');
        Route::get('/profile', [CustomerHomeController::class, 'profile'])->name('profile');

        // 🔥 TAMBAHAN: ORDER CUSTOMER
        Route::get('/order', [OrderController::class, 'create'])->name('order.create');
        Route::post('/order', [OrderController::class, 'store'])->name('order.store');
        Route::delete('/order/{transaction}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    });


// ─── ADMIN ONLY ────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);

    Route::get('/members/export-pdf', [MemberController::class, 'exportPdf'])->name('members.export-pdf');
    Route::resource('members', MemberController::class);
});


// ─── ADMIN & KASIR ─────────────────────────────────────────
Route::middleware(['auth', 'role:admin,kasir'])->group(function () {

    Route::get('/customers/export-pdf', [CustomerController::class, 'exportPdf'])->name('customers.export-pdf');
    Route::resource('customers', CustomerController::class);
    Route::get('/transactions/pdf', [TransactionController::class, 'pdf'])->name('transactions.pdf');
    Route::get('/transactions/{transaction}/struk', [TransactionController::class, 'struk'])->name('transactions.struk');

    // 🔥 TAMBAHAN: UPDATE STATUS
    Route::patch('/transactions/{transaction}/status', 
        [TransactionController::class, 'updateStatus']
    )->name('transactions.updateStatus');

    Route::resource('transactions', TransactionController::class);
});


require __DIR__ . '/auth.php';