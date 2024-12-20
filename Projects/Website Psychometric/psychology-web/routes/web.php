<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

// Quiz routes
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{id}', [QuizController::class, 'showQuestions'])->name('quizzes.showQuestions');
Route::post('/quizzes/submit', [QuizController::class, 'submitAnswers'])->name('quizzes.submitAnswers');
Route::get('/result', [QuizController::class, 'showResults'])->name('result');
