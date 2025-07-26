@extends('layouts.master-layout')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        {{-- Header Hasil --}}
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-6 mb-6 text-white">
            <h2 class="text-3xl font-bold mb-2">🎉 Hasil Kuis </h2>
            <p class="text-sm">Waktu Penyelesaian: <span id="waktu-indo-{{ $quizSession->id }}"></span></p>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const waktu = new Date("{{ $quizSession->completed_at->format('Y-m-d H:i:s') }}");
                    waktu.setHours(waktu.getHours() + 7);
                    const formatted = waktu.toLocaleString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }).replace(',', ' ');
                    document.getElementById('waktu-indo-{{ $quizSession->id }}').textContent = formatted;
                });
            </script>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold">{{ $quizSession->benar }}</p>
                    <p class="text-sm">Benar</p>
                </div>
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold">{{ $quizSession->salah }}</p>
                    <p class="text-sm">Salah</p>
                </div>
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold">{{ intval($quizSession->skor) }}</p>
                    <p class="text-sm">Skor Akhir</p>
                </div>
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold">{{ ucfirst($quizSession->tingkatan) }}</p>
                    <p class="text-sm">Tingkat</p>
                </div>
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <p class="text-2xl font-bold">{{ ucfirst($quizSession->jenis_materi) }}</p>
                    <p class="text-sm">Jenis Materi</p>
                </div>
            </div>
        </div>

        {{-- Detail Jawaban --}}
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-white mb-4">📝 Review Jawaban</h3>

            @foreach ($quizSession->answers as $answer)
                <div
                    class="bg-gray-800 rounded-lg p-6 text-white border-l-4 {{ $answer->is_correct ? 'border-green-500' : 'border-red-500' }}">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-semibold text-yellow-400">Soal {{ $answer->nomor_soal }}</h4>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-bold {{ $answer->is_correct ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ $answer->is_correct ? '✅ Benar' : '❌ Salah' }}
                        </span>
                    </div>

                    <p class="mb-4 text-gray-100">{{ $answer->pertanyaan }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                        @foreach (['a', 'b', 'c', 'd'] as $option)
                            @php
                                $isCorrectAnswer = $option === $answer->jawaban_benar;
                                $isStudentAnswer = $option === $answer->jawaban_siswa;
                                $bgClass = 'bg-gray-700';

                                if ($isCorrectAnswer) {
                                    $bgClass = 'bg-green-600';
                                } elseif ($isStudentAnswer && !$isCorrectAnswer) {
                                    $bgClass = 'bg-red-600';
                                }
                            @endphp

                            <div class="p-2 {{ $bgClass }} rounded flex items-center">
                                <strong class="text-blue-400 mr-2">{{ strtoupper($option) }}:</strong>
                                <span>{{ $answer->opsi[$option] }}</span>
                                @if ($isCorrectAnswer)
                                    <span class="ml-auto text-green-300">✓</span>
                                @elseif($isStudentAnswer && !$isCorrectAnswer)
                                    <span class="ml-auto text-red-300">✗</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="text-sm text-gray-300">
                        <p><strong>Jawaban Anda:</strong>
                            {{ $answer->jawaban_siswa ? strtoupper($answer->jawaban_siswa) : 'Tidak dijawab' }}</p>
                        <p><strong>Jawaban Benar:</strong> {{ strtoupper($answer->jawaban_benar) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Action Buttons --}}
        @if (Auth::user() && Auth::user()->hasRole('guru'))
            <div class="mt-8 text-center space-x-4 mb-10">
                <a href="{{ route('riwayat.pengerjaan.soal') }}"
                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
                    📈 Lihat Riwayat
                </a>
            </div>
        @else
            <div class="mt-8 text-center space-x-4 mb-10">
                <a href="{{ route('generate.soal') }}"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    🔄 Buat Kuis Baru
                </a>
                <a href="{{ route('quiz.session.history') }}"
                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
                    📈 Lihat Riwayat
                </a>
            </div>
        @endif
    </div>
@endsection
