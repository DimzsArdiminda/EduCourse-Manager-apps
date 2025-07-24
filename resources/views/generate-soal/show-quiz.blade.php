{{-- resources/views/quiz/show.blade.php --}}
@extends('layouts.master-layout')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-gray-800 rounded-lg p-6 mb-6">
            <div class="flex justify-between items-center text-white">
                <h2 class="text-2xl font-bold">Kuis - {{ ucfirst($quizSession->tingkatan) }}</h2>
                <div class="text-right">
                    <p class="text-sm text-gray-300">Tanggal: {{ $quizSession->started_at->format('d/m/Y') }}</p>
                    <p class="text-lg font-semibold">{{ $quizSession->total_soal }} Soal</p>
                </div>
            </div>
        </div>

        <form action="{{ route('quiz.session.submit', $quizSession->id) }}" method="POST" id="quizForm">
            @csrf
            <div class="space-y-6">
                @foreach ($quizSession->answers as $answer)
                    <div class="bg-gray-800 rounded-lg p-6 text-white">
                        <h3 class="font-semibold mb-3 text-yellow-400">Soal {{ $answer->nomor_soal }}:</h3>
                        <p class="mb-4 text-gray-100">{{ $answer->pertanyaan }}</p>

                        <div class="space-y-2">
                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <label
                                    class="flex items-center p-3 bg-gray-700 rounded hover:bg-gray-600 transition cursor-pointer">
                                    <input type="radio" name="answers[{{ $answer->nomor_soal }}]"
                                        value="{{ $option }}" class="mr-3 h-4 w-4 text-blue-600" required>
                                    <span class="text-blue-400 font-semibold mr-2">{{ strtoupper($option) }}:</span>
                                    <span>{{ $answer->opsi[$option] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-green-600 to-blue-600 text-white rounded-lg hover:from-green-700 hover:to-blue-700 transition font-bold text-lg">
                    ✅ Selesai Kuis
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menyelesaikan kuis? Jawaban tidak bisa diubah setelah submit.')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
