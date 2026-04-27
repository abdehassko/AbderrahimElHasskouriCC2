<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::get('/search-users', [UserController::class, 'search'])
        ->name('search-users');

    Route::get('/patients', [UserController::class, 'patients'])
        ->name('patients.index');

    Route::get('/doctors', [UserController::class, 'doctors'])
        ->name('doctors.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('services', ServiceController::class);

    Route::get('/search-services', [ServiceController::class, 'search'])
        ->name('search-services');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('appointments', AppointmentController::class);

    Route::get('/search-appointments', [AppointmentController::class, 'search'])
        ->name('search-appointments');
});







Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

require __DIR__ . '/auth.php';