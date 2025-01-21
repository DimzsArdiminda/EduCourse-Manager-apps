<?php

namespace App\Http\Controllers\mvpController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenDataKursus;
use App\Models\Siswa;

class mvpController extends Controller
{
    public function searchCourses(Request $request) {
        $search = $request->get('q'); // Ambil parameter pencarian dari Select2
    
        // Filter data berdasarkan kolom Nama_kursus
        $courses = ManajemenDataKursus::where('Nama_kursus', 'LIKE', "%{$search}%")
            ->select('id', 'Nama_kursus') // Ambil hanya kolom yang dibutuhkan
            ->get();
    
        return response()->json([
            'results' => $courses
        ]);
    }
    
    
    public function UpdateDataSiswa(Request $req){
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
        $courses->status = $req->status;
        $courses->updated_at = now();
        $courses->save();
        return redirect()->route('siswa')->with('success', 'data updated successfully');
    }

    public function addDataCourseSiswa(Request $req){
        // form validation
        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'course' => 'required',
            'status' => 'required',
            
        ]);
        
        $getDataCourse = ManajemenDataKursus::where('id', $req->course)->first();
        
        $courses = new Siswa;
        $courses->Nama = $req->name;
        $courses->email = $req->email;
        $courses->id_kursus = $req->course;
        $courses->nama_kursus = $getDataCourse->Nama_kursus;
        $courses->Status_Pembayaran = $req->status;
        $courses->tanggal_daftar = $req->Tanggal_daftar;
        $courses->created_at = now();
        $courses->updated_at = now();

        $updateDataCourse = ManajemenDataKursus::find($req->course);
        if ($updateDataCourse->jumlah_siswa_terdaftar == null) {
            $updateDataCourse->jumlah_siswa_terdaftar = 1;
        } else {
            $updateDataCourse->jumlah_siswa_terdaftar += 1;
        }
        $courses->save();
        $updateDataCourse->save();
        return redirect()->route('siswa')->with('success', 'data added successfully');
    }

    // done
    public function deleteDataCoursesSiswa($id){
        $courses = Siswa::find($id);
        // dd($courses);
        $courses->delete();
        return redirect()->route('siswa')->with('success', 'data deleted successfully');
    }

    // done
    // show by id
    public function getDataByIDSiswa($id){
        $courses = Siswa::find($id);
        return view('users.partial.byid', compact('courses',));
    }

    // done
    public function getDataByIDForUPdateSiswa($id){
        $courses = Siswa::find($id);
        $getIDKursus = ManajemenDataKursus::find($courses->id_kursus);
        // dd($courses);
        return view('users.partial.edit', compact('courses', 'getIDKursus'));
    }

    // done
    // manage data courses siswa
    public function indexSiswa(){

        $courses = Siswa::orderBy('created_at', 'desc')->get();
        // dd($courses);

        return view('users.courses', compact('courses'));
    }

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
        $courses->status = $req->status;
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
        return redirect()->route('courses')->with('success', 'data deleted successfully');
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
