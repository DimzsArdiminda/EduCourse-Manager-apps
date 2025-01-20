@extends('layouts.master-layout')

@section('content')
    <div class="p-6 text-gray-900">
        <b>
            <h1 class="text-3xl">{{ $courses->Nama_kursus }}</h1>
        </b>
        <p class="mt-4">
            <b>Description</b> : {{ $courses->Deskripsi }}
            <br>
            <b>Price:</b> Rp {{ number_format($courses->Harga, 0, ',', '.') }}

        </p>

        {{-- layout --}}
        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
            <div class="p-4 bg-white shadow-md rounded-lg">
                <h5 class="text-lg font-semibold">Status</h5>
                <p>{{ $courses->Status }}</p>
            </div>
            <div class="p-4 bg-white shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Number of Students</h2>
                <p>{{ $courses->jumlah_siswa_terdaftar ?? 0 }}</p>
            </div>
            <div class="p-4 bg-white shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Created At</h2>
                <p class="text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($courses->created_at)->format('d-m-Y H:i') }}
                </p>
            </div>
        </div>
    </div>

   
@endsection
