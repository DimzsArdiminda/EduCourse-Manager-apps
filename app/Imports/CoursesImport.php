<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use App\Models\ManajemenDataKursus;

use Maatwebsite\Excel\Concerns\ToModel;

class CoursesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi jika nama_kursus kosong
        if (empty($row['nama_kursus'])) {
            // \Log::error('Nama_kursus kosong pada baris: ' . json_encode($row));
            session()->push('failedRows', 'Nama kursus kosong pada baris: ' . json_encode($row));
            return null;
        }

        // Cek apakah kursus sudah ada di database
        $existingCourse = ManajemenDataKursus::where('Nama_kursus', $row['nama_kursus'])->first();
        if ($existingCourse) {
            // Simpan pesan error ke session
            session()->push('failedRows', $row['nama_kursus'] . " already exists");
            return null;  // Abaikan baris yang sudah ada
        }

        // Simpan data kursus baru
        return new ManajemenDataKursus([
            'Nama_kursus' => Str::title($row['nama_kursus']), // Format menjadi Title Case
            'Deskripsi' => $row['deskripsi'] ?? 'No description',
            'Harga' => $row['harga'] ?? 0,
            'Status' => $row['status'] ?? 'Aktif',
            'jumlah_siswa_terdaftar' => $row['jumlah_siswa_terdaftar'] ?? 0,
        ]);
    }
}
