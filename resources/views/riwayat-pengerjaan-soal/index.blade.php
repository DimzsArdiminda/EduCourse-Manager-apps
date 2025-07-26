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
                                    Nama siswa: {{ ucfirst($session->user->name) }}<br>
                                </h3>
                                <p class="text-sm text-gray-300 mb-1">
                                    Dikerjakan: <span id="waktu-indo-{{ $session->id }}"></span> WIB
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const waktu = new Date("{{ $session->completed_at->format('Y-m-d H:i:s') }}");
                                            waktu.setHours(waktu.getHours() + 7);
                                            const formatted = waktu.toLocaleString('id-ID', {
                                                day: '2-digit',
                                                month: '2-digit',
                                                year: 'numeric',
                                                hour: '2-digit',
                                                minute: '2-digit'
                                            }).replace(',', ' ');
                                            document.getElementById('waktu-indo-{{ $session->id }}').textContent = formatted;
                                        });
                                    </script>
                                </p>
                            </div>
                            <div class="text-right">
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
                <p class="text-xl mb-4">📝 Belum ada riwayat kuis dari siswa</p>
            </div>
        @endif
    </div>
@endsection
