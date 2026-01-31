<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Customer\RentalController as CustomerRentalController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            // 📊 DASHBOARD
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // 📦 BARANG (KAMERA & DRONE)
            Route::resource('items', ItemController::class);

            // 📑 DATA PENYEWAAN
            Route::get('/rentals', [AdminRentalController::class, 'index'])
                ->name('rentals.index');

            // ✅ KONFIRMASI PEMBAYARAN
            Route::patch('/rentals/{rental}/confirm',
                [AdminRentalController::class, 'confirm'])
                ->name('rentals.confirm');

            // ❌ TOLAK PEMBAYARAN
            Route::patch('/rentals/{rental}/reject',
                [AdminRentalController::class, 'reject'])
                ->name('rentals.reject');

            // 📦 BARANG DIAMBIL CUSTOMER
            Route::patch('/rentals/{rental}/take',
                [AdminRentalController::class, 'take']) // ⬅️ konsisten
                ->name('rentals.take');

            // 🔁 BARANG DIKEMBALIKAN
            Route::patch('/rentals/{rental}/returned',
                [AdminRentalController::class, 'returned'])
                ->name('rentals.returned');
        });

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['customer'])
        ->prefix('customer')
        ->name('customer.')
        ->group(function () {

            // 🧑‍💼 DASHBOARD
            Route::get('/dashboard', function () {
                return view('customer.dashboard');
            })->name('dashboard');

            // 📦 LIST BARANG
            Route::get('/items',
                [CustomerRentalController::class, 'index'])
                ->name('items.index');

            Route::get('/items/kamera',
                [CustomerRentalController::class, 'kamera'])
                ->name('items.kamera');

            Route::get('/items/drone',
                [CustomerRentalController::class, 'drone'])
                ->name('items.drone');

            // 🔄 SEWA BARANG
            Route::get('/sewa/{item}',
                [CustomerRentalController::class, 'create'])
                ->name('rentals.create');

            Route::post('/sewa/{item}',
                [CustomerRentalController::class, 'store'])
                ->name('rentals.store');

            // 📜 RIWAYAT SEWA
            Route::get('/rentals',
                [CustomerRentalController::class, 'myRentals'])
                ->name('rentals.my');

            // 🧾 BUKTI PEMINJAMAN  ⭐ FITUR BARU
            Route::get('/rentals/{rental}/receipt',
                [CustomerRentalController::class, 'receipt'])
                ->name('rentals.receipt');
        });

    /*
    |--------------------------------------------------------------------------
    | PROFILE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
