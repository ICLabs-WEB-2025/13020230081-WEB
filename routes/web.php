<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrashTypeController;

Route::get('/', [LandingController::class, 'index'])->name('welcome');
Route::post('/lapor', [LandingController::class, 'storeLaporan'])->name('lapor.store');

// Admin Panel
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('schedules', ScheduleController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('trash-types', TrashTypeController::class);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
