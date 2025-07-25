<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard/courses/add', function () {
    return view('courses.partial.add');
})->name('courses.add')->middleware(['auth', 'verified']);


Route::get('/dashboard/students/add', function () {
    return view('users.partial.add');
})->name('users.add')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
include 'fromController.php';
include 'openAPI.php';
