<?php

use App\Http\Controllers\GeminiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController\HomeController;
use App\Http\Controllers\mvpController\mvpController;
use App\Http\Controllers\MateriController;



// Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified', 'cek_metode'])->name('dashboard');


Route::middleware(['auth', 'role:guru', 'verified'])->group(function () {
    // Courses
    Route::get('/dashboard/courses', [mvpController::class, 'indexCourses'])->name('courses');
    Route::get('/dashboard/courses/{id}', [mvpController::class, 'getDataByID'])->name('courses.id');
    Route::get('/dashboard/courses/{id}/edit', [mvpController::class, 'getDataByIDForUPdate'])->name('courses.id.edit');
    Route::delete('/dashboard/courses/{id}', [mvpController::class, 'deleteDataCourses'])->name('courses.delete');
    Route::post('/dashboard/courses/add-bro', [mvpController::class, 'addDataCourse'])->name('courses.add.bro');
    Route::post('/dashboard/courses/update-bro', [mvpController::class, 'UpdateDataCourse'])->name('courses.update.bro');

    // Siswa
    Route::get('/dashboard/siswa', [mvpController::class, 'indexSiswa'])->name('siswa');
    Route::get('/dashboard/siswa/{id}', [mvpController::class, 'getDataByIDSiswa'])->name('siswa.id');
    Route::get('/dashboard/siswa/{id}/edit', [mvpController::class, 'getDataByIDForUPdateSiswa'])->name('siswa.id.edit');
    Route::delete('/dashboard/siswa/{id}', [mvpController::class, 'deleteDataCoursesSiswa'])->name('siswa.delete');
    Route::post('/dashboard/siswa/add-bro', [mvpController::class, 'addDataCourseSiswa'])->name('siswa.add.bro');
    Route::post('/dashboard/siswa/update-bro', [mvpController::class, 'UpdateDataSiswa'])->name('siswa.update.bro');
    Route::get('/api/courses/search', [mvpController::class, 'searchCourses'])->name('select.courses');
});

// export data
Route::get('/dashboard/export/courses', [mvpController::class, 'exportDataCourses'])->middleware(['auth', 'verified'])->name('export.courses');
// import data
Route::post('/dashboard/import/courses', [mvpController::class, 'importDataCourses'])->middleware(['auth', 'verified'])->name('courses.import.excel');
Route::get('/dashboard/export/courses/export', [mvpController::class, 'getPDF'])->middleware(['auth', 'verified'])->name('export.courses.export');

// Kuis Pemilihan Peminatan Metode Belajar
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quiz', [QuestionController::class, 'showKuis'])->name('quiz.show');
    Route::post('/quiz', [QuestionController::class, 'processSetiapPertanyaan'])->name('quiz.process');

    Route::post('/quiz/submit', [QuestionController::class, 'submitKuis'])->name('quiz.submit');
    Route::get('/quiz/submit', [QuestionController::class, 'hasilKuis'])->name('hasil.quiz.submit');
});

// membuat materi
Route::middleware(['auth', 'verified'])->prefix('dashboard/materi')->name('materi.')->group(function () {
    Route::get('/', [MateriController::class, 'index'])->name('index');
    Route::post('/store', [MateriController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [MateriController::class, 'delete'])->name('delete');
    Route::put('/edit/{id}', [MateriController::class, 'edit'])->name('edit');
});

// gemini routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/gemini', [GeminiController::class, 'showForm'])->name('gemini.form');
    Route::post('/gemini/generate', [GeminiController::class, 'generateText'])->name('gemini.generate');
});
