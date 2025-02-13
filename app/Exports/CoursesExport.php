<?php

namespace App\Exports;

use App\Models\ManajemenDataKursus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoursesExport implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ManajemenDataKursus::select('Nama_kursus', 'Deskripsi', 'Harga', 'Status', 'jumlah_siswa_terdaftar', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return [
            'Nama kursus', 'Deskripsi', 'Harga', 'Status', 'Jumlah Siswa Terdaftar', 'Dibuat pada tanggal', 'Tanggal terakhir di update'
        ];
    }
}
