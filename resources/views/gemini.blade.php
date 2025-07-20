@extends('layouts.layout') <!-- atau bisa pakai layout default -->

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Gemini Text Generator</h2>

        <form action="{{ route('gemini.generate') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="text" class="form-label">Masukkan Prompt</label>
                <textarea name="text" id="text" class="form-control" rows="4">{{ old('text') }}</textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary">Kirim</button>
        </form>

        @if (isset($response))
            <div class="mt-4">
                <h4>Jawaban Gemini:</h4>
                <div class="alert alert-success">{!! nl2br(e($response)) !!}</div>
            </div>
        @endif

        @if (isset($error))
            <div class="alert alert-danger mt-4">{{ $error }}</div>
        @endif
    </div>
@endsection
