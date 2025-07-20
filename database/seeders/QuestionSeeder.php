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
                'pertanyaan' => '1.	Saya sangat suka...',
                'answers' => [
                    ['teks_jawaban' => 'Mencatat', 'type' => 'visual'],
                    ['teks_jawaban' => 'Bercerita', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Menjiplak', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '2.	Saya suka membaca dengan...',
                'answers' => [
                    ['teks_jawaban' => 'Cepat', 'type' => 'visual'],
                    ['teks_jawaban' => 'Suara keras', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Jari sebagai penunjuk', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '3.	Saya paling suka belajar dengan...',
                'answers' => [
                    ['teks_jawaban' => 'Membaca', 'type' => 'visual'],
                    ['teks_jawaban' => 'Mendengarkan', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Bergerak', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '4.	Saya mudah mengingat dengan apa yang...',
                'answers' => [
                    ['teks_jawaban' => 'Saya lihat', 'type' => 'visual'],
                    ['teks_jawaban' => 'Saya dengar', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Saya tulis', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '5.	Apabila mencatat, saya...',
                'answers' => [
                    ['teks_jawaban' => 'Banyak catatan disertai gambar', 'type' => 'visual'],
                    ['teks_jawaban' => 'Sedikit mencatat karena lebih suka mendengarkan', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Banyak catatan namun tidak disertai gambar', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '6.	Saya menjawab pertanyaan dengan jawaban...',
                'answers' => [
                    ['teks_jawaban' => 'Ya atau tidak', 'type' => 'visual'],
                    ['teks_jawaban' => 'Panjang lebar (suka bercerita)', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Diikuti dengan gerkan anggota tubuh', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '7.	Saat belajar saya...',
                'answers' => [
                    ['teks_jawaban' => 'Tidak mudah terganggu dengan keributan', 'type' => 'visual'],
                    ['teks_jawaban' => 'Mudah terganggu dengan keributan', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Tidak dapat duduk diam dalam waktu lama', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '8.	Saya mengingat dengan cara...',
                'answers' => [
                    ['teks_jawaban' => 'Membayangkan', 'type' => 'visual'],
                    ['teks_jawaban' => 'Mengucapkan', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Sambil berjalan dan melihat', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '9.	Saya berbicara lebih suka...',
                'answers' => [
                    ['teks_jawaban' => 'Melihat wajah langsung', 'type' => 'visual'],
                    ['teks_jawaban' => 'Lewat telepon', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Memperhatikan Gerakan tubuh', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '10. Ketika berbicara saya...',
                'answers' => [
                    ['teks_jawaban' => 'Cepat', 'type' => 'visual'],
                    ['teks_jawaban' => 'Intonasi/berirama', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Lambat', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '11. Cara saya belajar bisanya suka...',
                'answers' => [
                    ['teks_jawaban' => 'Mengikuti petunjuk gambar', 'type' => 'visual'],
                    ['teks_jawaban' => 'Sambil berbicara', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Berbicara sambil menulis', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '12. Saya sering mengisi waktu luang dengan...',
                'answers' => [
                    ['teks_jawaban' => 'Menonton', 'type' => 'visual'],
                    ['teks_jawaban' => 'Mendengarkan music', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Bermain game', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '13. Saya lebih mudah memahami pelajaran dengan...',
                'answers' => [
                    ['teks_jawaban' => 'Melihat peraga', 'type' => 'visual'],
                    ['teks_jawaban' => 'Berdiskusi', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Praktik', 'type' => 'kinestetik'],
                ],
            ],
            [
                'pertanyaan' => '14. Saya lebih menyukai...',
                'answers' => [
                    ['teks_jawaban' => 'Gambar', 'type' => 'visual'],
                    ['teks_jawaban' => 'Musik', 'type' => 'audiotori'],
                    ['teks_jawaban' => 'Permainan', 'type' => 'kinestetik'],
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
