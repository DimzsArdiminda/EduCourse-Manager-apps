<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dataManagement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Nama_kursus' => 'Belajar Laravel',
                'Deskripsi' => 'Belajar Laravel dari dasar hingga mahir',
                'Harga' => 50000,
                'Status' => 'Aktif',
                'jumlah_siswa_terdaftar' => 10,
            ],
            [
                'Nama_kursus' => 'Belajar PHP',
                'Deskripsi' => 'Belajar PHP dari dasar hingga mahir',
                'Harga' => 50000,
                'Status' => 'Aktif',
                'jumlah_siswa_terdaftar' => null,
            ],
            [
                'Nama_kursus' => 'Belajar Javascript',
                'Deskripsi' => 'Belajar Javascript dari dasar hingga mahir',
                'Harga' => 50000,
                'Status' => 'Aktif',
                'jumlah_siswa_terdaftar' => null,
            ],
            [
                'Nama_kursus' => 'Belajar Ruby',
                'Deskripsi' => 'Belajar Ruby dari dasar hingga mahir',
                'Harga' => 50000,
                'Status' => 'Tidak Aktif',
                'jumlah_siswa_terdaftar' => NULL,
            ],
            [
                'Nama_kursus' => 'Belajar Python',
                'Deskripsi' => 'Belajar Python, dari dasar hingga mahir',
                'Harga' => 50000,
                'Status' => 'Aktif',
                'jumlah_siswa_terdaftar' => NULL,
            ],
        ];

        foreach ($data as $key => $value) {
            \App\Models\ManajemenDataKursus::create($value);
        }
    }
}
