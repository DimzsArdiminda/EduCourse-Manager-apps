@extends('layouts.master-layout')

@section('content')
<div class="p-6 text-gray-900 dark:text-gray-100">
    <b>
        <h1 class="text-3xl">Add Courses</h1>
    </b>

        {{-- layout form --}}
        <form action="{{ route('siswa.add.bro') }}" method="POST">
            @csrf
            <div class="grid  grid-cols-1 gap-4 mt-8 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                    <div class="mb-5 mt-5">
                        <label for="name" class="block mb-2 text-sm font-medium ">Name Student</label>
                        <input type="text" name="name" required id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium ">Email</label>
                        <input type="email" name="email" required id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 mt-5">
                        <label for="Tanggal_daftar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Registation </label>
                        <input type="date" name="Tanggal_daftar" required id="Tanggal_daftar" value="{{ old('Tanggal_daftar') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    @error('Tanggal_daftar')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <div class="mb-5">
                        <label for="courses" class="block mb-2 text-sm font-medium">Select Course</label>
                        <select id="selectCourse" name="course" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </select>
                        @error('course')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="status" class="block mb-2 text-sm font-medium ">Payment Status</label>
                        <select name="status" required id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Lunas" {{ old('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Belum Lunas" {{ old('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        </select>
                    </div>
                </div>
               
                {{-- button --}}
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Course
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
