<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController\HomeController;


Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');