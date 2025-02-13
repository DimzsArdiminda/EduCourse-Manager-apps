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
        $activeCount = ManajemenDataKursus::where('status', 'Aktif')->count();
        $inactiveCount = ManajemenDataKursus::where('status', 'Tidak Aktif')->count();

        // siswa
        // $getSiswa = Siswa::all();
        $siswaCount = Siswa::all()->count();
        // Hitung jumlah Lunas dan Belum Lunas
        $siswaLunasCount = Siswa::where('Status_Pembayaran', "Lunas")->count();
        $siswaBelumLunasCount = Siswa::where('Status_Pembayaran', "Belum Lunas")->count();
    
        // Kirimkan data ke view
        return view('dashboard', compact( 'getDataManajamend','activeCount','siswaCount', 'inactiveCount', 'siswaLunasCount', 'siswaBelumLunasCount'));
    }
    
}
