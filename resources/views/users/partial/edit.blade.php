@extends('layouts.master-layout')

@section('content')
    <div class="p-6 text-gray-900">
        <b>
            <h1 class="text-3xl">Courses Data</h1>
        </b>

        {{-- layout form --}}
        <form action="{{ route('courses.update.bro') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <div class="p-4 bg-white shadow-md rounded-lg">
                    <div class="mb-5 mt-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" required id="name" value="{{ $courses->Nama }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <input type="hidden" name="id" required id="name" value="{{ $courses->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-5 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="email" name="email" required id="name" value="{{ $getIDKursus->Nama_kursus }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-5 mt-5">
                        <label for="Tanggal_daftar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Registation </label>
                        <input type="date" name="Tanggal_daftar" required id="Tanggal_daftar" value="{{ $courses->tanggal_daftar }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-5">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" required id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Lunas" {{ $courses->Status_Pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Belum Lunas" {{ $courses->Status_Pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        </select>
                    </div>
                </div>

                
               
                {{-- button --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        update Course
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
