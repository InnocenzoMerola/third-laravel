<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PageController::class, 'home'])->name('home');



Route::middleware(['auth', 'verified'])->group(function () {
    // queste rotte sono accessibili solo se si è autenticati e verificati

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Route::get('/books',            [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create',      [BookController::class, 'create'])->name('books.create');
    // Route::get('/books/{id}',       [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{id}/edit',  [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books',           [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{id}',       [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}',    [BookController::class, 'destroy'])->name('books.destroy');

    // Questo permette di prendere tutte tranne, in questo caso, 'index' e 'show'
    // Route::resource('books', BookController::class)->except(['index', 'show']);
});
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/list', [BookController::class, 'list'])->name('books.list');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Questo permette di prendere solo, in questo caso, 'index' e 'show'
// Route::resource('books', BookController::class)->only(['index', 'show']);



Route::middleware('auth')->group(function () {
    // queste rotte sono accessibili solo se si è loggati

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function(){
    // queste rotte sono accessibili solo se non si è loggati
});

require __DIR__.'/auth.php';


