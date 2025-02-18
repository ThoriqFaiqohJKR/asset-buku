<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;

// Route untuk login Admin
Route::get('/admin/login', [ControllerLogin::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [ControllerLogin::class, 'loginAdmin']);

// Middleware langsung dipanggil di route
Route::prefix('admin')->name('admin.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('dashboard', [ControllerLogin::class, 'showAdminDashboard'])->name('dashboard');

    // Routes untuk Users
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('buku')->name('admin.buku.')->middleware('auth')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index');      // admin.buku.index
        Route::get('/create', [BukuController::class, 'create'])->name('create');  // admin.buku.create
        Route::post('/', [BukuController::class, 'store'])->name('store');     // admin.buku.store
        Route::get('/{id}/edit', [BukuController::class, 'edit'])->name('edit');  // admin.buku.edit
        Route::put('/{id}', [BukuController::class, 'update'])->name('update');  // admin.buku.update
        Route::delete('/{id}', [BukuController::class, 'destroy'])->name('destroy'); // admin.buku.destroy
        Route::get('/{id}/detail', [BukuController::class, 'show'])->name('detail'); // admin.buku.detail
        Route::get('/{id}/pinjam', [BukuController::class, 'pinjam'])->name('pinjam');
    });

    // Tambahkan rute alias untuk buku.index tanpa admin
    Route::prefix('asset')->name('admin.asset.')->middleware('auth')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('index');      // admin.buku.index
        Route::get('/create', [AssetController::class, 'create'])->name('create');  // admin.buku.create
        Route::post('/', [AssetController::class, 'store'])->name('store');     // admin.buku.store
        Route::get('/{id}/edit', [AssetController::class, 'edit'])->name('edit');  // admin.buku.edit
        Route::put('/{id}', [AssetController::class, 'update'])->name('update');  // admin.buku.update
        Route::delete('/{id}', [AssetController::class, 'destroy'])->name('destroy'); // admin.buku.destroy
        Route::get('/{id}/detail', [AssetController::class, 'show'])->name('detail'); // admin.buku.detail
        Route::get('/{id}/pinjam', [AssetController::class, 'pinjam'])->name('pinjam');
    });

    Route::prefix('peminjaman')->name('admin.peminjaman.')->middleware('auth')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');      // admin.buku.index
        Route::get('/create', [PeminjamanController::class, 'create'])->name('create');  // admin.buku.create
        Route::post('/', [PeminjamanController::class, 'store'])->name('store');     // admin.buku.store
        Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])->name('edit');  // admin.buku.edit
        Route::put('/{id}', [PeminjamanController::class, 'update'])->name('update');  // admin.buku.update
        Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('destroy'); // admin.buku.destroy
        Route::get('/{id}/detail', [PeminjamanController::class, 'show'])->name('detail'); // admin.buku.detail

    });

    Route::prefix('contact')->name('admin.contact.')->middleware('auth')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');      // admin.buku.index
        Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');  // admin.buku.edit
        Route::put('/{id}', [ContactController::class, 'update'])->name('update');  // admin.buku.update
        Route::get('/{id}/detail', [ContactController::class, 'show'])->name('detail'); // admin.buku.detail

    });
});

Route::get('/admin/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('admin.logout');

Route::get('/user/book/{id}', [PublicController::class, 'show'])->name('user.book.detail');
Route::get('/user/list/book', [PublicController::class, 'list'])->name('user.book.list');
Route::get('/user/asset/{id}', [PublicController::class, 'showaseet'])->name('user.asset.detail');
Route::get('/user/list/asset', [PublicController::class, 'listasset'])->name('user.asset.list');

Route::get('/', function () {
    return redirect('/user/dashboard');
});

Route::get('/user/dashboard', [PublicController::class, 'index']);
