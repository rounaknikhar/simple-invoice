<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invoices
    Route::resource('invoice', InvoiceController::class);

    // Create invoice: Show the add product route.
    Route::get('/invoice/create/{invoice}/add-products', [InvoiceController::class, 'addProducts'])->name('invoice.create.show.add-products');
    // Create invoice: store added product.
    Route::post('/invoice/create/{invoice}/add-products', [InvoiceController::class, 'storeProducts'])->name('invoice.create.show.store-products');
});

require __DIR__.'/auth.php';
