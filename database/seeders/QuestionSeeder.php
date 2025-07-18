<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'pertanyaan' => 'Ketika belajar, kamu lebih suka...',
                'answers' => [
                    ['teks_jawaban' => 'Mendengarkan penjelasan guru', 'type' => 'audiotory'],
                    ['teks_jawaban' => 'Melihat gambar atau diagram', 'type' => 'visual'],
                    ['teks_jawaban' => 'Melakukan praktik langsung', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => 'Saat membaca buku, kamu lebih menikmati...',
                'answers' => [
                    ['teks_jawaban' => 'Mendengarkan buku audio', 'type' => 'audiotory'],
                    ['teks_jawaban' => 'Melihat ilustrasi dan grafik', 'type' => 'visual'],
                    ['teks_jawaban' => 'Menyalin ulang atau membuat catatan', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => 'Jika diminta menghafal, kamu lebih suka...',
                'answers' => [
                    ['teks_jawaban' => 'Membaca dengan suara keras', 'type' => 'audiotory'],
                    ['teks_jawaban' => 'Melihat gambar atau video', 'type' => 'visual'],
                    ['teks_jawaban' => 'Berjalan sambil menghafal', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => 'Ketika belajar kelompok, kamu cenderung...',
                'answers' => [
                    ['teks_jawaban' => 'Mendengarkan dan berdiskusi', 'type' => 'audiotory'],
                    ['teks_jawaban' => 'Menggunakan catatan atau diagram', 'type' => 'visual'],
                    ['teks_jawaban' => 'Bermain peran atau praktik langsung', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => 'Untuk memahami pelajaran, kamu paling terbantu dengan...',
                'answers' => [
                    ['teks_jawaban' => 'Penjelasan verbal', 'type' => 'audiotory'],
                    ['teks_jawaban' => 'Tampilan slide atau gambar', 'type' => 'visual'],
                    ['teks_jawaban' => 'Simulasi atau praktik langsung', 'type' => 'kinestetik'],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $question = Question::create([
                'pertanyaan' => $q['pertanyaan']
            ]);

            foreach ($q['answers'] as $a) {
                Answer::create([
                    'question_id' => $question->id,
                    'teks_jawaban' => $a['teks_jawaban'],
                    'type' => $a['type'],
                ]);
            }
        }
    }
}
