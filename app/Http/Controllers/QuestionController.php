<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showKuis()
    {
        $questions = Question::with('answers')->get();
        $minat = auth()->user()->minat;

        $current = session('quiz.current', 0);
        $answers = session('quiz.answers', []);

        if ($current >= count($questions)) {
            return redirect()->route('quiz.finish');
        }

        return view('quiz.single', [
            'pertanyaan' => $questions[$current],
            'minat' => $minat,
            'index' => $current,
            'total' => count($questions),
            'selected' => $answers[$questions[$current]->id] ?? null
        ]);
    }

    public function processSetiapPertanyaan(Request $request)
    {
        $questions = Question::all();
        $current = session('quiz.current', 0);

        $answers = session('quiz.answers', []);
        $questionId = $questions[$current]->id;

        if ($request->has('answer')) {
            $answers[$questionId] = $request->input('answer');
            session(['quiz.answers' => $answers]);
        }

        if ($request->has('next')) {
            $current++;
        } elseif ($request->has('back')) {
            $current--;
        }

        session(['quiz.current' => $current]);

        if ($current >= count($questions)) {
            return redirect()->route('quiz.submit');
        }

        return redirect()->route('quiz.show');
    }

    public function submitKuis(Request $request)
    {
        $user = auth()->user();
        $answers = session('quiz.answers', []);

        if (empty($answers)) {
            return redirect()->route('quiz.show')->with('error', 'Jawaban tidak ditemukan. Silakan ulangi kuis.');
        }

        $counts = ['audiotory' => 0, 'visual' => 0, 'kinestetik' => 0];

        foreach ($answers as $questionId => $answerId) {
            $answer = Answer::find($answerId);
            if (!$answer) continue;

            UserAnswer::create([
                'user_id' => $user->id,
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);

            if (isset($counts[$answer->type])) {
                $counts[$answer->type]++;
            }
        }

        $minat = array_search(max($counts), $counts);
        if ($minat !== null) {
            $user->minat = $minat;
            $user->save();

            session()->forget(['quiz.answers', 'quiz.current']);

            return redirect()->route('hasil.quiz.submit')->with('minat', $minat);
        }

        return redirect()->route('quiz.show')->with('error', 'Gagal menentukan minat. Silakan coba lagi.');
    }

    public function hasilKuis()
    {
        $minat = auth()->user()->minat;

        return view('quiz.hasil', [
            'minat' => $minat,
        ]);
    }
}
