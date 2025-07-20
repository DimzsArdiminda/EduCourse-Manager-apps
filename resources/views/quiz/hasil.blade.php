@extends('layouts.layout')
@section('content')
    <div class="position-absolute top-0 end-0 m-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
        <div class="bg-white shadow rounded p-4 w-100" style="max-width: 32rem;">
            <h3 class="text-center mb-3 fw-bold text-primary">Hasil Minat Belajar Kamu</h3>

            @if (isset($minat))
                <p class="text-center text-secondary mb-2">Berdasarkan jawabanmu, kamu termasuk tipe belajar:</p>
                <h2 class="text-center h4 fw-semibold text-info mb-3">{{ ucfirst($minat) }}</h2>

                <p class="mt-3 text-center text-dark">
                    Kamu bisa belajar lebih efektif dengan pendekatan
                    <strong class="text-info">{{ ucfirst($minat) }}</strong> seperti:
                </p>

                <ul class="mt-4 list-unstyled text-center text-dark">
                    @if ($minat === 'audiotori')
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>🔊</span> Mendengarkan
                            penjelasan guru</li>
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>🎧</span> Belajar
                            lewat audio atau diskusi</li>
                    @elseif ($minat === 'visual')
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>🖼️</span> Melihat
                            gambar, diagram, atau video</li>
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>📊</span> Menggunakan
                            grafik dan warna saat mencatat</li>
                    @elseif ($minat === 'kinestetik')
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>🛠️</span> Belajar
                            dengan praktik langsung</li>
                        <li class="d-flex align-items-center justify-content-center gap-2 mb-2"><span>🏃‍♂️</span>
                            Menggunakan gerakan saat belajar</li>
                    @endif
                </ul>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4">Menuju ke Dashboard</a>
                </div>
            @else
                <p class="text-center text-muted">Belum ada hasil yang bisa ditampilkan.</p>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <a href="{{ route('quiz.show') }}" class="btn btn-primary px-4 me-2">Quiz</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger px-4">Logout</a>
                </div>
            @endif


        </div>
    </div>
@endsection
