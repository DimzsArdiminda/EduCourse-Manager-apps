@extends('layouts.layout')

@section('content')
    <div class="position-absolute top-0 end-0 m-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <div class="container mt-5 position-relative">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-7">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="mb-3 text-center fw-bold">Pilih Minat Anda</h4>
                        <p class="text-muted text-center mb-4">
                            Hasil kuis Anda menunjukkan dua tipe minat yang sama kuat.<br>
                            Silakan pilih salah satu:
                        </p>
                        <form action="{{ route('quiz.choose.minat.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3 text-center">
                                @foreach ($topInterests as $minat)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="minat"
                                            id="minat_{{ $minat }}" value="{{ $minat }}" required>
                                        <label class="form-check-label" for="minat_{{ $minat }}">
                                            {{ ucfirst($minat) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Simpan Pilihan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
