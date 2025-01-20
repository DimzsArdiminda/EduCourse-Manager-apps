<?php

namespace App\Http\Controllers\mvpController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenDataKursus;
use App\Models\Siswa;

class mvpController extends Controller
{
    // manage data courses
    public function indexCourses(){

        $courses = ManajemenDataKursus::all();
        // dd($courses);

        return view('courses.courses', compact('courses'));
    }
}
