<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;


Route::get('/', function () {
    return view('welcome');
})->name("welcome");
Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");

Route::get('/register', function () {
    return view('auth.register');
})->name("register");

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::middleware('auth')->group(function () {
    // usercase
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/users/create', [AuthController::class, 'showRegistrationForm'])->name('users.create');
    
    Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');

    Route::get('/users', [AuthController::class, 'index'])->name('users.index');

    Route::get('users/{id}/edit', [AuthController::class, 'edit'])->name('users.edit');

    Route::put('/users/{id}', [AuthController::class, 'update'])->name('users.update');
    
    Route::post('/users/create', [AuthController::class, 'store'])->name('user.create');

    // Route::post('/register', [AuthController::class, 'store'])->name('register');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    

    // notes case
    Route::get('/notes/create', function () {
    return view('notes.create');
    })->middleware(['auth', 'verified'])->name('notes.create');

    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/notes/create', [NoteController::class, 'store'])->name('notes.create');
    Route::get('notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');



});


require __DIR__.'/auth.php';
