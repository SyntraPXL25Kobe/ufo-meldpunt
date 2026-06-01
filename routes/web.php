<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MyReportsController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', fn() => view('home'))->name('home');
Route::get('/over-ons', fn() => view('over-ons'))->name('over-ons');

// Submit a report (guest & logged in)
Route::get('/report', [ReportController::class, 'create'])->name('reports.create');
Route::post('/report', [ReportController::class, 'store'])->name('reports.store');
Route::get('/report/thank-you', [ReportController::class, 'thankYou'])->name('reports.thank-you');

// My reports (logged in only)
Route::get('/my-reports', [MyReportsController::class, 'index'])->name('my-reports.index')->middleware('auth');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/registreren', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/registreren', [AuthController::class, 'register']);
    Route::get('/inloggen', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/inloggen', [AuthController::class, 'login']);
});

Route::post('/uitloggen', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
