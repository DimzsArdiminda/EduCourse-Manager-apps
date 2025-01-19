<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'data_siswa';
    protected $guarded = [];
    public $timestamps = true;

    public function manajemen_data()
    {
        return $this->belongsTo(ManajemenDataKursus::class);
    }
}
