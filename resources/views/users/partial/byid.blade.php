@extends('layouts.master-layout')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <b>
            <h1 class="text-3xl">{{ $courses->Nama }}</h1>
        </b>
        <p class="mt-4">
            <b>Email</b> : {{ $courses->email }}
            <br>
        </p>

        {{-- layout --}}
        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 ">
            <a href="{{ route('courses.id', $courses->id_kursus) }}" class="transition-transform transform hover:scale-105">
                <div class="p-4 dark:bg-gray-700 shadow-md rounded-lg text-gray-900 dark:text-gray-100">
                    <h5 class="text-lg font-semibold">Course Name</h5>
                    <p>{{ $courses->nama_kursus }}</p>
                </div>
            </a>
            <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Date Of Registation</h2>
                <p>{{ $courses->tanggal_daftar }}</p>
            </div>
            <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Payment Status</h2>
                <p class="text-sm text-gray-600">
                    @if ($courses->Status_Pembayaran == 'Lunas')
                        <span class="bg-green-200 text-green-800 rounded-full px-3 py-1">Lunas</span>
                    @else
                        <span class="bg-red-200 text-red-800 rounded-full px-3 py-1">Belum Lunas</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

   
@endsection
