<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baseController\openApiController;

// Routes for Siswa
Route::get('/api/siswa', [openApiController::class, 'indexSiswa']); // List all Siswa
Route::get('/api/siswa/{id}', [openApiController::class, 'getDataByIDSiswa']); // Get Siswa by ID
Route::post('/api/siswa', [openApiController::class, 'addDataCourseSiswa']); // Add Siswa
Route::put('/api/siswa/{id}', [openApiController::class, 'updateDataSiswa']); // Update Siswa
Route::delete('/api/siswa/{id}', [openApiController::class, 'deleteDataCoursesSiswa']); // Delete Siswa

// Routes for Courses
Route::get('/api/courses', [openApiController::class, 'indexCourses']); // List all Courses
Route::get('/api/courses/{id}', [openApiController::class, 'getDataByID']); // Get Course by ID
Route::post('/api/courses', [openApiController::class, 'addDataCourse']); // Add Course
Route::put('/api/courses/{id}', [openApiController::class, 'UpdateDataCourse']); // Update Course
Route::delete('/api/courses/{id}', [openApiController::class, 'deleteDataCourses']); // Delete Course

// Search for courses (for Select2 or similar)
Route::get('search-courses', [openApiController::class, 'searchCourses']); // Search courses
