<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// User Authentication Page
Route::get('/login', function () {
    return view('livewire.pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('livewire.pages.auth.register');
})->name('register');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Form Submission
Route::middleware(['auth'])->group(function () {
    Route::get('/form', [EntryController::class, 'create'])->name('form');
    Route::post('/form', [EntryController::class, 'store'])->name('form.submit');
});

require __DIR__ . '/auth.php';
