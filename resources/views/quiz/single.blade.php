@extends('layouts.layout')

@section('content')
    <div class="position-absolute top-0 end-0 m-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>

    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="w-100" style="max-width: 600px;">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    @if (Auth::check() && Auth::user()->minat === null)
                        <form action="{{ $index + 1 == $total ? route('quiz.submit') : route('quiz.process') }}" method="POST" class="mb-0">
                            @csrf

                            <div class="mb-4">
                                <h4 class="card-title mb-2">Soal {{ $index + 1 }} dari {{ $total }}</h4>
                                <p class="card-text">{{ $pertanyaan->pertanyaan }}</p>
                            </div>

                            <div class="mb-4">
                                @foreach ($pertanyaan->answers as $answer)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="answer" id="answer{{ $answer->id }}" value="{{ $answer->id }}" {{ $selected == $answer->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="answer{{ $answer->id }}">
                                            {{ $answer->teks_jawaban }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                @if ($index > 0)
                                    <button type="submit" name="back" class="btn btn-secondary">Kembali</button>
                                @else
                                    <div></div>
                                @endif

                                @if ($index + 1 == $total)
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                @else
                                    <button type="submit" name="next" class="btn btn-primary">Berikutnya</button>
                                @endif
                            </div>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <p class="h5 text-success fw-semibold">Anda sudah menyelesaikan kuis ini.</p>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-info text-white">Kembali ke Dashboard</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
