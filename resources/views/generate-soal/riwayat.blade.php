{{-- resources/views/quiz/history.blade.php --}}
@extends('layouts.master-layout')

@section('content')
    <div class="max-w-6xl mx-auto mt-10">
        <h2 class="text-3xl font-bold text-white mb-6">📈 Riwayat Kuis</h2>

        @if ($quizSessions->count() > 0)
            <div class="grid gap-4">
                @foreach ($quizSessions as $session)
                    <div class="bg-gray-800 rounded-lg p-6 text-white">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-yellow-400 mb-2">
                                    Kuis {{ ucfirst($session->tingkatan) }} - {{ $session->total_soal }} soal
                                </h3>
                                <p class="text-sm text-gray-300 mb-1">
                                    Dikerjakan: {{ $session->completed_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="flex space-x-4 mb-2">
                                    <div class="text-center">
                                        @if($session->skor == 0)
                                            <p class="text-2xl font-bold text-red-500">{{ intval($session->skor) }}</p>
                                        @else
                                            <p class="text-2xl font-bold text-green-400">{{ intval($session->skor) }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400">Skor akhir</p>
                                    </div>
                                </div>
                                <a href="{{ route('quiz.session.result', $session->id) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $quizSessions->links() }}
            </div>
        @else
            <div class="bg-gray-800 rounded-lg p-8 text-center text-white">
                <p class="text-xl mb-4">📝 Belum ada riwayat kuis</p>
                <p class="text-gray-400 mb-6">Mulai dengan membuat dan mengerjakan kuis pertama Anda!</p>
                <a href="{{ route('generate.soal') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Buat Kuis Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
