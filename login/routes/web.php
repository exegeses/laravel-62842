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


/*################*/
### CRUD de marcas
use App\Http\Controllers\MarcaController;
Route::get('/marcas', [ MarcaController::class, 'index' ])
            ->middleware(['auth'])
            ->name('marcas');
Route::get('/marca/create', [ MarcaController::class, 'create' ])
            ->middleware(['auth']);
Route::post('/marca/store', [ MarcaController::class, 'store' ])
            ->middleware(['auth']);
Route::get('/marca/edit/{marca}', [ MarcaController::class, 'edit' ])
            ->middleware(['auth']);
Route::put('/marca/update/{marca}', [ MarcaController::class, 'update' ])
            ->middleware(['auth']);
Route::get('/marca/delete/{marca}', [ MarcaController::class, 'delete' ])
            ->middleware(['auth']);
Route::delete('/marca/destroy/{marca}', [ MarcaController::class, 'destroy' ])
            ->middleware(['auth']);


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
