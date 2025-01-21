<?php

namespace App\Http\Controllers\mvpController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenDataKursus;
use App\Models\Siswa;

class mvpController extends Controller
{
    public function UpdateDataCourse(Request $req){
        // dd($req->all());
        // form validation
        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $courses = ManajemenDataKursus::find($req->id);
        $courses->nama_kursus = $req->name;
        $courses->deskripsi = $req->description;
        $courses->harga = $req->price;
        $courses->updated_at = now();
        $courses->save();
        return redirect()->route('courses')->with('success', 'data updated successfully');
    }

    public function addDataCourse(Request $req){
        // dd($req->all());
        // form validation
        $req->validate([
            'name' => 'required|unique:manajemen_data,nama_kursus',
            'description' => 'required',
            'price' => 'required'
        ]);

        $courses = new ManajemenDataKursus;
        $courses->nama_kursus = $req->name;
        $courses->deskripsi = $req->description;
        $courses->harga = $req->price;
        $courses->created_at = now();
        $courses->updated_at = now();
        $courses->jumlah_siswa_terdaftar = null;
        $courses->save();
        return redirect()->route('courses')->with('success', 'data added successfully');
    }
    public function deleteDataCourses($id){
        $courses = ManajemenDataKursus::find($id);
        $courses->delete();
        return redirect()->route('courses');
    }
    // show by id
    public function getDataByID($id){
        $courses = ManajemenDataKursus::find($id);
        // dd($courses);
        return view('courses.partial.byid', compact('courses'));
    }

    public function getDataByIDForUPdate($id){
        $courses = ManajemenDataKursus::find($id);
        // dd($courses);
        return view('courses.partial.edit', compact('courses'));
    }
    // manage data courses
    public function indexCourses(){

        $courses = ManajemenDataKursus::orderBy('created_at', 'desc')->get();
        // dd($courses);

        return view('courses.courses', compact('courses'));
    }
}
