<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;

class ManajemenDataKursus extends Model
{
    protected $table = 'manajemen_data';
    protected $fillable = ['Nama_kursus', 'Deskripsi', 'Harga', 'Status', 'jumlah_siswa_terdaftar'];
    public $timestamps = true;

    public function data_siswa()
    {
        return $this->hasMany(siswa::class);
    }
}
