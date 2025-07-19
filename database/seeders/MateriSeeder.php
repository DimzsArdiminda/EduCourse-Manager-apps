<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModelMateri as Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MateriFile = "https://drive.google.com/file/d/17nMWWCvjOBRD5qNZG-VbhtIJUR67ut1-/view?usp=sharing";
        $MateriVideo = "https://youtu.be/dUoU9I4zD3U?si=hI0ZPWORo2yLbP1E";


        Materi::create([
            'title' => 'Materi Belajar - File',
            'link_materi' => $MateriFile,
            'link_gform' => 'https://forms.gle/8Z1b7d5g3z9k2f4y6',
            'tipe' => 'file',
            'tipe_belajar' => 'kinestetik',
        ]);

        Materi::create([
            'title' => 'Materi Belajar - Video',
            'link_materi' => $MateriVideo,
            'link_gform' => 'https://forms.gle/8Z1b7d5g3z9k2f4y6',
            'tipe' => 'video',
            'tipe_belajar' => 'visual',
        ]);

        Materi::create([
            'title' => 'Materi Belajar - Video',
            'link_materi' => $MateriVideo,
            'link_gform' => 'https://forms.gle/8Z1b7d5g3z9k2f4y6',
            'tipe' => 'video',
            'tipe_belajar' => 'auditori',
        ]);
    }
}
