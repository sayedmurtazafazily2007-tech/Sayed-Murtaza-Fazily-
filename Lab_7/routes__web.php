<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CourseController::class, 'index'])
        ->name('dashboard');

    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
