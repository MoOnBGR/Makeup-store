<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportController;

// Página principal: dashboard con los productos, público (sin login)
Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Catálogo, detalle de producto y carrito: públicos
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Solo el checkout (pagar) exige estar autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/confirmacion/{order}', [CheckoutController::class, 'confirmacion'])->name('checkout.confirmacion');
});

// Reportes de ventas: solo administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/ventas/pdf', [ReportController::class, 'ventasPdf'])->name('reports.ventas.pdf');

    Route::get('/admin/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/usuarios/{user}/toggle-admin', [App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');

    Route::get('/admin/administrativos', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.admins.index');
    Route::post('/admin/administrativos', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.admins.store');
});

require __DIR__.'/auth.php';