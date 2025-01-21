<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class siswacihuy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example3.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example2.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example3.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example4.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example5.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example6.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example7.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example8.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'email' => 'example9.com',
            'id_kursus' => 3,
            'nama_kursus' => 'Belajar php',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
    }
}
