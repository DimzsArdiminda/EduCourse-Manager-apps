<?php

namespace App\Http\Controllers;

use App\Models\QuizSession;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Auth;

class GenerateSoalController extends Controller
{
    protected $apiKey;
    protected $apiUrl;
    protected $httpClient;

    public function __construct()
    {
        $this->apiKey = "AIzaSyBBzzalzgpTfk5AGpanns08pz2OWacK6jI";
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-2.5-pro:generateContent?key=' . $this->apiKey;
        $this->httpClient = new Client();
    }

    public function index()
    {
        return view('generate-soal.index');
    }

    public function generateSoalForm()
    {
        return view('generate-soal.generate');
    }

    public function generateSoalResult(Request $request)
    {
        $request->validate([
            'tingkatan' => 'required|string|in:mudah,sedang,sulit',
            'jenis_materi' => 'required|string',
            'jumlah' => 'required|integer|min:1',
        ]);

        $tingkatan = $request->input('tingkatan');
        $jenis_materi = $request->input('jenis_materi');
        $jumlah = $request->input('jumlah');

        $prompt = "Buatkan saya $jumlah soal pilihan ganda matematika dengan topik $jenis_materi yang dilengkapi soal cerita budaya/etno daerah malang secara acak untuk siswa SMA dan sederajat dengan tingkat kesulitan $tingkatan. Tampilkan hasil dalam format JSON array dengan struktur seperti ini:
[
  {
    \"pertanyaan\": \"...\",
    \"opsi\": {
      \"a\": \"...\",
      \"b\": \"...\",
      \"c\": \"...\",
      \"d\": \"...\"
    },
    \"jawaban\": \"b\"
  }
]
Tanpa kalimat pembuka, tanpa penjelasan, dan hasilkan hanya JSON valid.";

        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->httpClient->post($this->apiUrl, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                $rawText = trim($result['candidates'][0]['content']['parts'][0]['text']);

                $rawText = preg_replace('/^```json|```$/m', '', $rawText);
                $rawText = trim($rawText);

                $parsedJson = json_decode($rawText, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    session(['generated_soals' => $parsedJson, 'tingkatan' => $tingkatan, 'jenis_materi' => $jenis_materi]);

                    return view('generate-soal.generate', [
                        'soals' => $parsedJson,
                        'tingkatan' => $tingkatan,
                        'jenis_materi' => $jenis_materi
                    ]);
                } else {
                    return view('generate-soal.generate', [
                        'error' => 'Format JSON tidak valid',
                        'raw' => $rawText
                    ]);
                }
            }

            return view('generate-soal.generate', ['error' => 'Respons tidak ditemukan']);
        } catch (Exception $e) {
            return view('generate-soal.generate', ['error' => 'Gagal: ' . $e->getMessage()]);
        }
    }

    public function startQuiz(Request $request)
    {
        $tingkatan = session('tingkatan');
        $soals = session('generated_soals');
        $jenis_materi = session('jenis_materi');

        if (!$soals) {
            return redirect()->back()->with('error', 'Tidak ada soal yang tersedia. Silakan generate soal terlebih dahulu.');
        }

        $quizSession = QuizSession::create([
            'user_id' => Auth::id(),
            'tingkatan' => $tingkatan,
            'soals' => $soals,
            'jenis_materi' => $jenis_materi,
            'total_soal' => count($soals),
            'started_at' => now()
        ]);

        foreach ($soals as $index => $soal) {
            QuizAnswer::create([
                'quiz_session_id' => $quizSession->id,
                'nomor_soal' => $index + 1,
                'pertanyaan' => $soal['pertanyaan'],
                'opsi' => $soal['opsi'],
                'jawaban_benar' => $soal['jawaban']
            ]);
        }

        return redirect()->route('quiz.session.show', $quizSession->id);
    }

    public function showQuiz($sessionId)
    {
        $quizSession = QuizSession::with('answers')->findOrFail($sessionId);

        if ($quizSession->status === 'completed') {
            return redirect()->route('quiz.session.result', $sessionId);
        }

        return view('generate-soal.show-quiz', compact('quizSession'));
    }

    public function submitAnswer(Request $request, $sessionId)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string|in:a,b,c,d'
        ]);

        $quizSession = QuizSession::findOrFail($sessionId);

        $answers = $request->input('answers');
        $benar = 0;
        $salah = 0;

        foreach ($answers as $nomorSoal => $jawabanSiswa) {
            $quizAnswer = QuizAnswer::where('quiz_session_id', $sessionId)
                ->where('nomor_soal', $nomorSoal)
                ->first();

            if ($quizAnswer) {
                $isCorrect = $jawabanSiswa === $quizAnswer->jawaban_benar;

                $quizAnswer->update([
                    'jawaban_siswa' => $jawabanSiswa,
                    'is_correct' => $isCorrect,
                    'answered_at' => now()
                ]);

                if ($isCorrect) {
                    $benar++;
                } else {
                    $salah++;
                }
            }
        }

        $skor_hasil = ($benar / $quizSession->total_soal) * 100;

        $quizSession->update([
            'benar' => $benar,
            'salah' => $salah,
            'skor' => $skor_hasil,
            'status' => 'completed',
            'completed_at' => now()
        ]);

        $quizSession->calculateScore();

        return redirect()->route('quiz.session.result', $sessionId);
    }

    public function showResult($sessionId)
    {
        $quizSession = QuizSession::with('answers')->findOrFail($sessionId);

        return view('generate-soal.hasil', compact('quizSession'));
    }

    public function quizHistory()
    {
        $quizSessions = QuizSession::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->paginate(5);

        return view('generate-soal.riwayat', compact('quizSessions'));
    }

    public function quizHistoryGuru() {
        $quizSessions = QuizSession::paginate(5);
        return view('riwayat-pengerjaan-soal.index', compact('quizSessions'));
    }
}
