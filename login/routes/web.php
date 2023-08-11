<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* rutas con nombre */
    /* middleware(['auth']) */
Route::view('/origen', 'origen')
        ->middleware(['auth']);
Route::view('/destino', 'destino')
            ->middleware(['auth'])
            ->name('destino');






Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
