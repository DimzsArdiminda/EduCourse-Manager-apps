<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController\HomeController;
use App\Http\Controllers\mvpController\mvpController;



// Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Courses
Route::get('/dashboard/courses', [mvpController::class, 'indexCourses'])->middleware(['auth', 'verified'])->name('courses');
