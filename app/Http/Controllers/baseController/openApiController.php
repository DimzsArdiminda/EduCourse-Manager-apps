<?php

namespace App\Http\Controllers\baseController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenDataKursus;
use App\Models\Siswa;

class openApiController extends Controller
{
    public function searchCourses(Request $request)
    {
        $search = $request->get('q');

        $courses = ManajemenDataKursus::where('Nama_kursus', 'LIKE', "%{$search}%")
            ->where('status', 'Aktif')
            ->select('id', 'Nama_kursus') 
            ->get();

        return response()->json([
            'status' => 'success',
            'results' => $courses
        ]);
    }

    public function updateDataSiswa(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
            'status' => 'required',
        ]);

        $courses = Siswa::find($req->id);
        if (!$courses) {
            return response()->json(['status' => 'error', 'message' => 'Siswa not found'], 404);
        }

        $getDataCourse = ManajemenDataKursus::find($req->course);
        if (!$getDataCourse) {
            return response()->json(['status' => 'error', 'message' => 'Course not found'], 404);
        }

        $dataLamaDariSiswa = $courses;
        $dataDariManajemen = $getDataCourse;
        $getOldData = ManajemenDataKursus::find($dataLamaDariSiswa->id_kursus);

        $courses->Nama = $req->name;
        $courses->email = $req->email;
        $courses->id_kursus = $req->course;
        $courses->nama_kursus = $getDataCourse->Nama_kursus;
        $courses->Status_Pembayaran = $req->status;
        $courses->tanggal_daftar = $req->Tanggal_daftar;
        $courses->updated_at = now();

        if ($dataLamaDariSiswa->id_kursus != $dataDariManajemen->id) {
            $dataDariManajemen->jumlah_siswa_terdaftar += 1;
            $getOldData->jumlah_siswa_terdaftar -= 1;
        }

        $dataDariManajemen->save();
        $getOldData->save();
        $courses->save();

        return response()->json(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    public function addDataCourseSiswa(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:data_siswa,email',
            'course' => 'required',
            'status' => 'required',
        ]);

        $getDataCourse = ManajemenDataKursus::find($req->course);
        if (!$getDataCourse) {
            return response()->json(['status' => 'error', 'message' => 'Course not found'], 404);
        }

        $courses = new Siswa;
        $courses->Nama = $req->name;
        $courses->email = $req->email;
        $courses->id_kursus = $req->course;
        $courses->nama_kursus = $getDataCourse->Nama_kursus;
        $courses->Status_Pembayaran = $req->status;
        $courses->tanggal_daftar = $req->Tanggal_daftar;
        $courses->created_at = now();
        $courses->updated_at = now();

        $getDataCourse->jumlah_siswa_terdaftar += 1;
        $courses->save();
        $getDataCourse->save();

        return response()->json(['status' => 'success', 'message' => "{$courses->Nama} data is registered"]);
    }

    public function deleteDataCoursesSiswa($id)
    {
        $courses = Siswa::find($id);
        if (!$courses) {
            return response()->json(['status' => 'error', 'message' => 'Siswa not found'], 404);
        }

        $getDataCourse = ManajemenDataKursus::find($courses->id_kursus);
        if ($getDataCourse) {
            $getDataCourse->jumlah_siswa_terdaftar -= 1;
            $getDataCourse->save();
        }
        $courses->delete();

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully']);
    }

    public function getDataByIDSiswa($id)
    {
        $courses = Siswa::find($id);
        if (!$courses) {
            return response()->json(['status' => 'error', 'message' => 'Siswa not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $courses]);
    }

    public function indexSiswa()
    {
        $courses = Siswa::orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $courses]);
    }

    public function indexCourses()
    {
        $courses = ManajemenDataKursus::orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $courses]);
    }
}
