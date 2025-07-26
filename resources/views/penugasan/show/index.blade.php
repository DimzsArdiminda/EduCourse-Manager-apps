@extends('layouts.master-layout')
@section('content')


    <div class="p-6 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
        <b>
            <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>

        <div class="mt-3">
            @include('components.alerts')
        </div>

        {{-- form input tanggal --}}
       
        <p class="mt-4">Welcome to your profile. <br>
                Disini anda bisa membuat materi pembelajaran, siapkan link Gdrive materi anda (PDF disarankan) <br>
                Dan anda bisa memberikan soal latihan untuk siswa anda dengan mengirimkan link Google Form yang sudah anda buat.
        </p>

        {{ $materi->judul_materi }}
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">Detail Materi</h2>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-bold">{{ $materi->title }}</h3>

                <p class="text-gray-700 dark:text-gray-300 mt-2">Tipe Materi: {{ $materi->tipe }}<br>Tipe Belajar: {{ $materi->tipe_belajar }}</p>
                
                @if($materi->tipe === 'video')
                    {{-- Preview YouTube Video --}}
                    @php
                        preg_match('/(?:v=|\/embed\/|\.be\/)([a-zA-Z0-9_-]+)/', $materi->link_materi, $matches);
                        $youtubeId = $matches[1] ?? null;
                    @endphp
                    @if($youtubeId)
                        <div class="mt-4">
                            <iframe width="855" height="315" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @endif
                @elseif($materi->tipe === 'file')
                    {{-- Preview PDF Google Drive --}}
                    @php
                        // Extract file ID from Google Drive link
                        preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $materi->link_materi, $matches);
                        $fileId = $matches[1] ?? null;
                    @endphp
                    @if($fileId)
                        <div class="mt-4">
                            <iframe src="https://drive.google.com/file/d/{{ $fileId }}/preview" width="100%" height="480" allow="autoplay"></iframe>
                        </div>
                    @endif
                @endif

                <p class="text-gray-700 dark:text-gray-300 mt-2">Atau Akses lewat link : <a href="{{ $materi->link_materi }}" class="text-blue-600 hover:underline">{{ $materi->link_materi }}</a></p>
                <p class="text-gray-700 dark:text-gray-300 mt-2">Link Soal: <a href="{{ $materi->link_gform }}" class="text-blue-600 hover:underline">{{ $materi->link_gform }}</a></p>
            </div>
        </div>
    </div>

@endsection
