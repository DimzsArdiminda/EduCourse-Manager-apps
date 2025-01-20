<?php

namespace App\Http\Controllers\baseController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManajemenDataKursus;
use App\Models\Siswa;

class HomeController extends Controller
{
    public function index(){
        // data management
        $getDataManajamend = ManajemenDataKursus::all()->count();
        // Hitung jumlah aktif dan tidak aktif
        $activeCount = ManajemenDataKursus::where('status', 'aktif')->count();
        $inactiveCount = ManajemenDataKursus::where('status', 'tidak aktif')->count();

        // siswa
        // $getSiswa = Siswa::all();
        $siswaCount = Siswa::all()->count();
        // Hitung jumlah Lunas dan Belum Lunas
        $siswaLunasCount = Siswa::where('Status Pembayaran', "Lunas")->count();
        $siswaBelumLunasCount = Siswa::where('Status Pembayaran', "Belum Lunas")->count();
    
        // Kirimkan data ke view
        return view('dashboard', compact( 'getDataManajamend','activeCount','siswaCount', 'inactiveCount', 'siswaLunasCount', 'siswaBelumLunasCount'));
    }
    
}
