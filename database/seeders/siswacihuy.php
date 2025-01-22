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
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example3@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example2@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example3@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example4@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example5@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example6@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example7@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example8@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
        Siswa::create([
            'Nama' => 'Rizky',
            'id_kursus' => 1,
            "nama_kursus" => "Belajar Laravel",
            'email' => 'example9@gmail.com',
            'tanggal_daftar' => '2025-03-02',
            'Status_Pembayaran' => 'Lunas',
        ]);
    }
}
