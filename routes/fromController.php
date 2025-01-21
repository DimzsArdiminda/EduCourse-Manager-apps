<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController\HomeController;
use App\Http\Controllers\mvpController\mvpController;



// Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Courses
Route::get('/dashboard/courses', [mvpController::class, 'indexCourses'])->middleware(['auth', 'verified'])->name('courses');
Route::get('/dashboard/courses/{id}', [mvpController::class, 'getDataByID'])->middleware(['auth', 'verified'])->name('courses.id');
Route::get('/dashboard/courses/{id}/edit', [mvpController::class, 'getDataByIDForUPdate'])->middleware(['auth', 'verified'])->name('courses.id.edit');
Route::delete('/dashboard/courses/{id}', [mvpController::class, 'deleteDataCourses'])->middleware(['auth', 'verified'])->name('courses.delete');
Route::post('/dashboard/courses/add-bro', [mvpController::class, 'addDataCourse'])->middleware(['auth', 'verified'])->name('courses.add.bro');
Route::post('/dashboard/courses/update-bro', [mvpController::class, 'UpdateDataCourse'])->middleware(['auth', 'verified'])->name('courses.update.bro');

// Siswa
Route::get('/dashboard/siswa', [mvpController::class, 'indexSiswa'])->middleware(['auth', 'verified'])->name('siswa');
Route::get('/dashboard/siswa/{id}', [mvpController::class, 'getDataByIDSiswa'])->middleware(['auth', 'verified'])->name('siswa.id');
Route::get('/dashboard/siswa/{id}/edit', [mvpController::class, 'getDataByIDForUPdateSiswa'])->middleware(['auth', 'verified'])->name('siswa.id.edit');